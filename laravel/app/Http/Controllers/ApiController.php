<?php

namespace App\Http\Controllers;

use App\Models\SensorValue;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    /**
     * Добавление нового значения датчиком
     * 
     * @param Request $request
     * @return array
     */
    public function putValue(Request $request): array
    {
        $success = false;
        if ($sensorId = (int)$request->sensor) {
            $content = trim($request->getContent());
            $parsedContent = explode('=', $content);
            if (count($parsedContent) > 1 && in_array($parsedContent[0], ['T', 'P', 'v'])) {
                SensorValue::create([
                    'sensor_id' => $sensorId,
                    'key' => (string)$parsedContent[0],
                    'value' => (float)$parsedContent[1],
                ]);
                $success = true;
            } 
        }

        return [
            'success' => $success,
        ];
    }

    /**
     * Получение списка значений для SPA
     * 
     * @param Request $request
     * @return array
     */
    public function getValues(Request $request): array
    {
        $sensorId = (int)$request->sensor;
        $key = (string)$request->key;
        $from = $request->from;
        $to = $request->to;
        $items = [];
        $success = false;
        if ($sensorId && $key) {
            $itemsQuery = SensorValue::where('sensor_id', $sensorId)
                ->where('key', $key);
            if ($from) {
                $itemsQuery->where('created_at', '<=', Carbon::parse($from));
            }
            if ($to) {
                $itemsQuery->where('created_at', '>=', Carbon::parse($to));
            }

            $items = $itemsQuery->get();
            $success = true;
        }
        return [
            'success' => $success,
            'items' => $items,
        ];
    }
}
