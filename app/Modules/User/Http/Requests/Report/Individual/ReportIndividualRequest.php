<?php

namespace User\Http\Requests\Report\Individual;
use User\Http\Requests\BaseRequest;

class ReportIndividualRequest extends BaseRequest
{

    public function rules()
    {
        return [
            'reported_id'               => 'required|integer|exists:individuals,id',
            'account_report_reason_id'  => 'required|integer|exists:account_report_reasons,id',
            'other_reason'              => 'nullable|string|min:3|max:191',
            'comments'                  => 'required|string|min:3|max:99999',
        ];
    }

}
