<?php

namespace Admin\Exports\AccountReport;

use Maatwebsite\Excel\Concerns\FromCollection;

class ExportData implements FromCollection
{
    private $records;

    public function __construct($records)
    {
        $this->records = $records;
    }

    public function collection()
    {
        $records = $this->records;
        $data = collect([]);
        $data->push(['Id','Status','Sender','User','Reported User','Reason','Comment','Created at']);
        foreach ($records as $record) {
            $data->push([
                $record->id,
                $record->status,
                $record->senders(),
                $record->sender() ? $record->sender()->first_name .' '. $record->sender()->last_name  : "--",
                $record->ReportedUser ? $record->ReportedUser->first_name : "--",
                $record->reason ? $record->reason->reason : "--",
                $record->comments ? $record->comments : "--",
                date('d M Y', strtotime($record->created_at)) ." - ". date('h:i a', strtotime($record->created_at))
            ]);
        }
        return $data;
    }
}
