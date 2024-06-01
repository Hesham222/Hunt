<?php
namespace Admin\Actions\Notification;
use Illuminate\Http\Request;
use Admin\Actions\User\{
    Developer\PushNotificationAction as PushDevelopers,
    Broker\PushNotificationAction as PushBrokers,
    Individual\PushNotificationAction as PushIndividuals,
};

class PushAction
{
    public function execute(Request $request): void
    {
        $individuals = new PushIndividuals();
        $brokers = new PushBrokers();
        $developers = new PushDevelopers();
        if($request->input('type') == 'individuals')
            $individuals->execute($request);
        elseif($request->input('type') == 'brokers')
            $brokers->execute($request);
        elseif($request->input('type') == 'developers')
            $developers->execute($request);
        elseif($request->input('type') == 'specific')
        {
            if($request->input('specific_users') == 'individuals')
                $individuals->execute($request);
            elseif($request->input('specific_users') == 'specific')
                $brokers->execute($request);
            else
                $developers->execute($request);
        }
        else
        {
            $developers->execute($request);
            $individuals->execute($request);
            $brokers->execute($request);
        }
    }

}
