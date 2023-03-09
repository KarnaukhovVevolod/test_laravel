<?php

namespace App\Services;

use App\Models\UserData;

class UserDataService
{
    public function saveUserData(int $clientId, string $data): int
    {
        $userData = new UserData();
        $userData->client_id = $clientId;
        $userData->data_user = $data;
        $userData->created_at = now();
        $userData->save();
        return $userData->id;
    }

    public function updateUserData(int $id, int $clientId, $data): string
    {
        $updateUserData = UserData::where('id',$id)->first();
        if (isset($updateUserData->client_id) && $updateUserData->client_id != $clientId) {
            if ($updateUserData === null) {
                return 'нет записи в бд с id = '.$id;
            }
            abort(403,'Unauthorized');
        }
        $dbUserData = json_decode($updateUserData->data_user);
        $data = json_decode($data);
        $this->recursiveUpdate($dbUserData,$data);
        $updateUserData->data_user=json_encode($dbUserData);
        $updateUserData->save();
        return 'Данные успешно обновлены';
    }
    protected function recursiveUpdate (&$dbupdate, $data)
    {
        if (gettype($data) == "object") {
            $datanew = get_object_vars($data);
            $keyObject = key($datanew);
            $this->recursiveUpdate($dbupdate->{$keyObject}, $datanew[$keyObject]);
        } elseif(gettype($data)== "array") {
            foreach ($data as $key => $value) {
                if (gettype($value) == "object") {
                    $datanew = get_object_vars($value);
                    $keyObject = key($datanew);
                    $this->recursiveUpdate($dbupdate[$key]->{$keyObject}, $datanew[$keyObject]);
                } elseif (gettype($value) == 'array') {
                    $this->recursiveUpdate($dbupdate[$key], $value);
                } elseif (gettype($data) != "resource" && gettype($data) != "resource (closed)"
                    && gettype($data) != "unknown type") {
                        $dbupdate[$key] = $value;
                }
            }
        } elseif (gettype($data) != "resource" && gettype($data) != "resource (closed)"
            && gettype($data) != "unknown type") {
            $dbupdate = $data;
        }

    }

    public function deleteUserObject(int $id): void
    {
        //UserData::where('id', $id)->delete();
    }

}
