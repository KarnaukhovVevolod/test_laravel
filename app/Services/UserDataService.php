<?php

namespace App\Services;

use App\Models\UserData;

class UserDataService
{
    private $accordion_1_0 = ' <div class="accordion-item">
            <h2 class="accordion-header"> <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne_';
    private $accordion_1_1 = ' " aria-expanded="false" aria-controls="flush-collapseOne"> ';
                    //посмотреть  объекты пользователей
    private $accordion_2 = '  </button></h2> ';
    private $accordion_3_0 = '  <div id="flush-collapseOne_';
    private $accordion_3_1 = '" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">';
    private $accordion_4=' </div></div></div> ';

    private array $array = [];


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
            return'Увас нет прав на редактирование этого объекта';
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
            foreach ($datanew as $keyObject => $value) {
                if (is_null($dbupdate) or gettype($dbupdate) == 'string') {
                    $dbupdate = $data;
                }
                $this->recursiveUpdate($dbupdate->{$keyObject}, $value);
            }
        } elseif(gettype($data)== "array") {
            foreach ($data as $key => $value) {
                if (gettype($value) == "object") {
                    $datanew = get_object_vars($value);
                    foreach ($datanew as $keyObject => $value) {
                        $this->recursiveUpdate($dbupdate[$key]->{$keyObject}, $value);
                    }
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
    public function convertObjectToHtml(&$collections)
    {
        $number=100;
        foreach ($collections as &$collection) {
            $number++;
            $objectHtml = '';

            $json = json_decode($collection->data_user);
            if (gettype($json) == "object") {
                $object = get_object_vars($json);
                foreach ($object as $Key => &$objectValue) {
                    $number++;
                    $this->recursiveUpdateHtml($objectHtml, $objectValue, $number, $Key);
                }
                //$this->recursiveUpdateHtml($objectHtml, json_decode($collection->data_user),$number);
                //$number+=100;
                $collection->data_user = $objectHtml;
            }
        }
    }
    protected function recursiveUpdateHtml(&$dbupdate, $data, &$number, $Key=null)
    {
        if (gettype($data) == "object") {
            $number++;
            $dbupdate .= ' ' . $this->accordion_1_0 . $number . $this->accordion_1_1 . ' <br> тип object ' . ' <br> ключ ' . $Key . ' ' . $this->accordion_2 . ' ' . $this->accordion_3_0 . $number . $this->accordion_3_1;
            $datanew = get_object_vars($data);
            foreach ($datanew as $keyObject => $value) {
                $number++;
                $this->array[] = $number;
                $dbupdate .= ' ' . $this->accordion_1_0 . $number . $this->accordion_1_1 . ' <br> тип ' . gettype($data) . ' <br> ключ ' . $keyObject . ' ' . $this->accordion_2 . ' ' . $this->accordion_3_0 . $number . $this->accordion_3_1;
                $this->recursiveUpdateHtml($dbupdate, $value, $number);
            }
            $dbupdate.= $this->accordion_4;
        } elseif(gettype($data) == "array") {
            $number++;
            $dbupdate .= ' '.$this->accordion_1_0.$number.$this->accordion_1_1. ' <br> тип array '.$this->accordion_2. ' '.$this->accordion_3_0.$number.$this->accordion_3_1;
            foreach ($data as $key => $value) {
                if (gettype($value) == "object") {
                    $datanew = get_object_vars($value);
                    foreach ($datanew as $keyObject => $value) {
                        $number++;
                        $dbupdate .= ' '.$this->accordion_1_0 . $number . $this->accordion_1_1 . ' <br> тип object ' . ' <br> ключ ' /*. $key*/ . $keyObject . ' ' . $this->accordion_2 . $this->accordion_3_0 . $number . $this->accordion_3_1;
                        $this->recursiveUpdateHtml($dbupdate, $value, $number);
                    }
                } elseif (gettype($value) == 'array') {
                    $number++;
                    $dbupdate .= ' '.$this->accordion_1_0.$number.$this->accordion_1_1.' <br> тип  array ' .' <br> ключ '.$key .$this->accordion_2.$this->accordion_3_0.$number.$this->accordion_3_1;
                    $this->recursiveUpdateHtml($dbupdate, $value, $number);
                } elseif (gettype($data) != "resource" && gettype($data) != "resource (closed)"
                    && gettype($data) != "unknown type") {
                    $dbupdate .= ' <br> тип '.gettype($value).' <br> ключ: '.$key . ' <br> значение: '.$value.' ';
                }
            }
            $dbupdate.= $this->accordion_4;
        } elseif (gettype($data) != "resource" && gettype($data) != "resource (closed)"
            && gettype($data) != "unknown type") {
            $dbupdate .= ' <br> тип '. gettype($data).' <br> ключ: '.$Key . '<br> значение: '.$data . $this->accordion_4;
        }
    }



    public function deleteUserObject(int $id): void
    {
        UserData::where('id', $id)->delete();
    }


}
