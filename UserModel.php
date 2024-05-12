<?php
namespace faizavel\mvc;
use faizavel\mvc\db\DbModel;

abstract class UserModel extends DbModel
{

    abstract public function getDisplayName(): string;

}