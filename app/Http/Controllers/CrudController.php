<?php

namespace App\Http\Controllers;

use App\Repositories\UserDataRepository;
use App\Repositories\UsersRepository;
use App\Services\UserDataService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class CrudController extends Controller
{
    private UserDataService $userDataService;
    private UserDataRepository $userDataRepository;
    private UsersRepository $usersRepository;

    public function __construct()
    {
        $this->userDataService = app(UserDataService::class);
        $this->userDataRepository = app(UserDataRepository::class);
        $this->usersRepository = app(UsersRepository::class);
    }

    public function save(Request $request)
    {
        try {
            if ($data = $request->get('data')) {
                $start = microtime(true);
                $memory = memory_get_usage();
                $id = $this->userDataService->saveUserData(
                    (int) auth()->user()->getAuthIdentifier(),
                    $data
                );
                $time = (microtime(true) - $start) . ' сек. ';
                $memory = (memory_get_usage() - $memory) . ' байт';
                return response()->json(['time'=>$time, 'memory'=>$memory, 'id'=>$id],201);
            } else {
                return response()->json('Error: не передали данные для записи',400);
            }

        } catch (\Throwable $e) {
            return response()->json($e->getMessage(),505);
        }

        //echo 'Данные получены';
    }
    public function update(Request $request, $id)
    {
        try{
            if ($data = $request->get('data')) {
                $message = $this->userDataService->updateUserData(
                    (int) $id,
                    (int) auth()->user()->getAuthIdentifier(),
                    $data
                );
                return response()->json($message,202);
            } else {
                return response()->json('Error: не передали данные для записи',400);
            }
        } catch (\Throwable $e) {
            return response()->json([$e->getMessage(),$e->getFile(),$e->getLine()],505);
        }

    }

    public function viewDelete()
    {
        $usersObject = $this->userDataRepository->getAllDataObjectsUsers();
        $usersData = $this->usersRepository->getAllDataUsers();
        $this->userDataService->convertObjectToHtml($usersObject);
        return View::make('user.delete',['usersObject'=>$usersObject,'usersData'=>$usersData]);
    }

    public function delete(Request $request, $id)
    {
        $this->userDataService->deleteUserObject((int)$id);
        return Redirect::action([$this::class,'viewDelete']);
    }
}
