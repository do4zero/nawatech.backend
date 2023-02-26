<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiController as BaseController;
use App\Libs\Helpers;
use App\Libs\HttpStatusCode;

class LogicTesController extends BaseController
{
    /**
     * Get Format Response
     */
    public function getJsonFormat(){
        // Read File Booking JSON
        $bookingfile = 'bookings_file';
        $bookingsJson = Helpers::readfile($bookingfile)['data'];

        // Read File Workshops JSON
        $workshopfile = 'workshops_file';
        $workshopsJson = Helpers::readfile($workshopfile)['data'];

        // Sorting Params
        $sort = request()->input('sort') ?? SORT_ASC;

        $results = [];
        $i = 0;
        foreach ($bookingsJson as $row) {
            $customers =[
                'name' => $row['name'],
                'email' => $row['email']
            ];

            $data_booking = $row['booking'];
            $bookings = [
                'booking_number' =>  $data_booking['booking_number'],
                'book_date' => $data_booking['book_date']
            ];

            $data_workshop = $data_booking['workshop'];
            $workshop_address = Helpers::searchItems($workshopsJson, $data_workshop['code']);
            $workshops = [
                'ahass_code' => $data_workshop['code'],
                'ahass_name' =>  $data_workshop['name'],
                'ahass_address' => $workshop_address['address'] ?? '',
                'ahass_contact' => $workshop_address['phone_number'] ?? '',
                'ahass_distance' => $workshop_address['distance'] ?? 0,
            ];

            $data_motorcycle = $data_booking['motorcycle'];
            $motorcycles = [
                'motorcycle_ut_code' => $data_motorcycle['ut_code'],
                'motorcycle' => $data_motorcycle['name']
            ];

            $results[$i] = array_merge($customers, $bookings, $workshops, $motorcycles);
            $i++;
        }

        // Sorting By Ahass Distance
        $keys = array_column($results, 'ahass_distance');
        array_multisort($keys, (strtolower($sort) == 'asc' ? SORT_ASC : SORT_DESC), $results);

        return response()->json([
                            "status" => 1,
                            "message" => "Data Successfully Retrieved.",
                            "data" => $results
                        ],
                        HttpStatusCode::HTTP_200_OK);
    }
}
