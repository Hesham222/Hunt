<?php

namespace Admin\Exports\PostReport;

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
        $data->push(['Id','Status','Sender','User','Post Id','Reason','Comment','Created at']);
        foreach ($records as $record) {
            $data->push([
                $record->id,
                $record->status,
                $record->senders(),
                $record->sender() ? $record->sender()->first_name .' '. $record->sender()->last_name  : "--",
                $record -> post_id ?  $record->post_id : "--",
                $record->reason ? $record->reason->reason : "--",
                $record->comments ? $record->comments : "--",
                date('d M Y', strtotime($record->created_at)) ." - ". date('h:i a', strtotime($record->created_at))
            ]);
        }
        return $data;
    }
}
