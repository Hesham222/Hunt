<?php

namespace Admin\Exports\User\Broker;

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
        $data->push(['Id','Status', 'Name','Email','Phone','DOB','Created By', 'Created at']);
        foreach ($records as $record) {
            $data->push([
                $record->id,
                $record->status,
                $record->first_name .' '.$record->last_name,
                $record->email,
                $record->phone,
                $record->date_of_birth,
                $record->createdBy ? $record->createdBy->name : "",
                date('d M Y', strtotime($record->created_at)) ." - ". date('h:i a', strtotime($record->created_at))
            ]);
        }
        return $data;
    }
}
