<?php

use \PHPUnit\Framework\TestCase;

abstract class SendMessage
{
    abstract public function send();
}

class  Mail extends SendMessage
{
    public function send()
    {
        return 'send  message  by mail';
    }
}


class  User
{
    public $sender;
    public function __construct(SendMessage $sender)
    {
        $this->sender = $sender;
    }


}


class TestContainer extends TestCase
{
    //简单绑定
    public function testNew()
    {
        $container = new  Illuminate\Container\Container();
        $container->bind('app',function ($container){
            return 'aa';

        });

        $app = $container->make('app');
        print_r($app);
    }

    //绑定到实现
    public function testAbstract()
    {
        $container = new  Illuminate\Container\Container();
        $container->bind(SendMessage::class,Mail::class);

        $sender = $container->make(SendMessage::class)->send();
        echo $sender;

    }

    public function testResolve()
    {
        $container = new  Illuminate\Container\Container();
        $user = $container->build(User::class);
        print_r($user);

    }
}

