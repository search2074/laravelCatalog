<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

use App\Provider;
use App\Repositories\ProductRepository;
use Mail;

/**
 * Description of ListController
 *
 * @author User
 */
class ListController extends Controller {
    public $_valias = 'lists';
    
    protected $products;

    /**
     * Конструктор
     * @param ProductRepository $products
     */
    public function __construct(ProductRepository $products) {
        //в этом контроллере есть доступ только у аутентифицированных юзеров
        $this->middleware('auth');
        
        $this->products = $products;
    }
    
    public function products(Request $request){
		if ($request->session()->has('id_products') && $request->session()->has('select_fields')) {
			return view($this->getView('products'), [
				'products' => $this->products->findByIDs($request->user(), $request->session()->get('id_products')),
				'columns' => explode(',', $request->session()->get('select_fields')),
				'providers' => Provider::lists('email', 'id')
			]);
		} else {
			Session::flash('message', 'Ошибка, даные для формирования формы не получены.');
			return view('errors.empty');
		}
    }
    
	/**
	 * Отправить список товаров
	 * @param \App\Http\Requests\SendListPostRequest $request
	 * @return type
	 */
    public function send(Request $request){
		$this->validate($request, [
			'file' => ['mimes:jpg,jpeg,png', 'min:100', 'max:10000'],
		], [
			'mimes' => 'Недопустимый тип файла, разрешены только jpg, jpeg, png',
			'min' => 'Минимальный размер файла 100 килобайт',
			'max' => 'Максимальный размер файла 10 мегабайт',
		]);
		
		$emails = Provider::whereIn('providers.id', $request->get('providerslist'))->get()->toArray();
		$file = \App\Helpers\FileHelper::upload($request);
		$this->sendMail($request, $emails, $file);

		return view($this->getView('success'));
    }
	
	/**
	 * Отправляет письмо на почту
	 * @param \Illuminate\Http\Request $request
	 * @param type $file
	 */
	public function sendMail(Request $request, $emails, $file) {
		Mail::send('emails.products', [
			'products' => $this->products->findByIDs($request->user(), $request->session()->get('id_products')),
			'columns' => explode(',', $request->session()->get('select_fields')),
		], function ($m) use ($emails, $file) {
			$m->from(env('MAIL_FROM'), 'progerlife');
			
			foreach($emails as $value){
				$m->to($value['email'], $value['email'])->subject('Список товаров');
			}
			
			$m->attach($file);
		});
	}
}