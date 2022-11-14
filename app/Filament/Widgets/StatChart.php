<?php

namespace App\Filament\Widgets;

use Filament\Widgets\BarChartWidget;
use Filament\Widgets\BubbleChartWidget;
use Filament\Widgets\DoughnutChartWidget;
use Filament\Widgets\LineChartWidget;

class StatChart extends BarChartWidget
{

    protected function getHeading(): string
    {
        return 'Contract Chart';
    }



    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Stat Chart',
                    'data' => [0, 10, 5, 2, 21, 32, 45, 74, 65, 45, 77, 89],
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }
}
