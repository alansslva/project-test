<?php

namespace App\Application\User\Http\Controllers;

use App\core\Http\Controllers\Controller;
use App\Infra\Application\User\Creator\UserCreator;
use App\Infra\Application\User\DTO\UserDefaultDto;
use App\Infra\Application\User\Entities\User;
use App\Infra\Application\User\Models\User as UserModel;
use App\Infra\Application\User\Repositories\UserRepository;
use App\Infra\Application\User\Services\CreateUserService;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
       return (new UserRepository(new UserModel()))->getAll(new UserDefaultDto());
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|min:3',
            'document' => 'required|min:5',
            'email' => 'required|min:5',
            'password' => 'required|min:5',
            'value' => 'required|min:1',
            'type' => 'required|min:5',
        ]);

        if ($validator->fails())
        {
            return response()->json(['error' => $validator->errors()->all() ], 400);
        }

        $user  =  (new UserCreator(new User()))
            ->setName($request->name)
            ->setDocument($request->document)
            ->setEmail($request->email)
            ->setPassword($request->password)
            ->setValue((float) $request->value)
            ->setType($request->type)
            ->getUser();

        try{
            (new CreateUserService(
                $user,
                new UserRepository(new UserModel()),
                new UserModel()
            ))->execute();
        }catch (\Exception $e){
            return response()->json(['error' => 'Verifique os dados de cadastro' ], 409);
        }


    }
}
