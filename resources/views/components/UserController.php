<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Laravel\Fortify\Http\Responses\LogoutResponse;
use PhpParser\Node\Stmt\TryCatch;

class UserController extends Controller
{

    public function storeRegistro(Request $request)
    {
        try {

        } catch (\Throwable $th) {
            dd($th);
        }

    }

    public function destroy(Request $request): LogoutResponse
    {
        /**
         * Lógica para colocar el usuario inactivo en base de datos
         */
        $user = Auth::user();
        UtilsController::userInactivo($user->id);

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $request->session()->flush();

        return app(LogoutResponse::class);
    }
}
