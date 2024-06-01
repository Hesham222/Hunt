<?php

namespace Admin\Exports\Post;

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
        $data->push(['Id','Individual Name','Individual Phone','City','Area','Type','Reason','In a Compound',
            'Number of Rooms','Price From','Price To','Developer','Size of Property','Payment','Down payment From','Down payment To'
            ,'Monthly installment  From','Monthly installment to','Payment duration From','Payment duration  To',
        'Delivery date','Completion Type','Description','Status']);
        foreach ($records as $record) {
            $data->push([
                $record->id,
                $record->individual->first_name,
                $record->individual->phone,
                $record->city ? $record->city->name:"--",
                $record->area ? $record->area->name:"--",
                $record->type ? $record->type->type:"--",
                $record->reason ? $record->reason->type:"--",
                $record->getCompound(),
                $record->num_of_rooms,
                $record->start_price,
                $record->end_price,
                $record->developer,
                $record->size_of_property,
                $record->payment,
                $record->start_down_payment,
                $record->end_down_payment,
                $record->start_monthly_installment,
                $record->end_monthly_installment,
                $record->start_payment_duration,
                $record->end_payment_duration,
                $record->delivery_date,
                $record->createdBy ? $record->createdBy->name :"",
                date('d M Y', strtotime($record->created_at)) ." - ". date('h:i a', strtotime($record->created_at))
            ]);
        }
        return $data;
    }
}
