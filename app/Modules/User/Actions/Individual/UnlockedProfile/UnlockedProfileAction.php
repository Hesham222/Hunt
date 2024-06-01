<?php
namespace User\Actions\Individual\UnlockedProfile;

use Admin\Models\Individual;
use Illuminate\Http\Request;
use App\Http\Traits\FileTrait;
use User\Models\UnlockRequests;

class UnlockedProfileAction
{
    public function execute(Request $request)
    {
        return $record  = Individual::with('posts')->find($request->input('individual_id'));

    }
}
