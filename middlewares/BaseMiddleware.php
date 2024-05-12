<?php

namespace faizavel\mvc\middlewares;



abstract class BaseMiddleware
{
    abstract public function execute();
}