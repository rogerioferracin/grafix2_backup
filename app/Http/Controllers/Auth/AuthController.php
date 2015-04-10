<?php namespace Grafix\Http\Controllers\Auth;

use Grafix\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;

use Grafix\Http\Requests\Auth\LoginRequest;
use Grafix\User;

class AuthController extends Controller {

    /**
     * The model instance
     * @var User
     */
    protected $user;

    /**
     * The guard implementation
     * @var Authentication
     */
    protected $auth;

    /**
     * Create a new authentication controller instance
     */
    public function __construct(Guard $auth, User $user)
    {
        $this->user = $user;
        $this->auth = $auth;

        $this->middleware('guest', ['except'=>['getLogout']]);
    }

    /**
     * Show login app form
     * @return \Illuminate\View\View
     */
    public function getLogin()
    {
        return view('auth.login');
    }

    /**
     * handle a login post
     * @param LoginRequest $request
     */
    public function postLogin(LoginRequest $request)
    {
        if($this->auth->attempt($request->only('username', 'password'))){
            return \Redirect::intended('/');
        }

        \Toastr::warning('Ocorreu uma falha ao efetuar o login', 'Atenção');
        return redirect('auth/login')->withErrors([
            'username' => 'As informações utilizadas não coincidem com o cadastro do usuário. Tente novamente'
        ]);
    }

    public function getLogout()
    {
        $this->auth->logout();

        return redirect('/');
    }



}
