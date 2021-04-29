@extends('layout.main')

@section('content')

    <form method="post" action="{{ route('display_calender') }}">
        @csrf
        <div class="row">
            <div class="col-sm-3">
                <a class="btn btn-primary" href="{{ route('home') }}">Back To Home</a>
            </div>
            <div class="col-md-3">
                <div class="form-outline">
                    <label class="form-label" for="zodiac_sign_id">Choose A Zodiac Sign</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-outline">
                    <select class="form-control" name="zodiac_sign_id" id="zodiac_sign_id">

                    @foreach($zodiac_signs as $zodiac_sign)

                        <option value="{{ $zodiac_sign['id'] }}" {{ ($zodiac_sign['id'] == $zodiac_sign_id) ? ' selected="selected"' : '' }}>{{ $zodiac_sign['title'] }}</option>

                    @endforeach

                    </select>
                 </div>
            </div>
            <div class="col-md-3">
                <input type="hidden" name="year" value="{{ $haas_year }}">
                <div class="form-outline">
                    <button type="submit" class="btn btn-success btn-block mb-4">Show Calendar</button>
                 </div>
            </div>
        </div>
    </form>
    <br>
    <hr>
    <h3 class="text-center year">YEAR {{ $haas_year }}</h3>
    <br>
    <p class="text-center" style="color: blue;"><b>NOTE: HOVER OVER A DAY TO SEE HOROSCOPE PREDICTION OF THE DAY.</b></p>
    <br>

    <?php

        $months=array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');

        $month=0;
        $dayCount = 1;

        echo '<table class="calendar">';

        // Table of months
        for($row=1; $row<=3; $row++) {

            echo '<tr>';

            for ($column=1; $column<=4; $column++) {

                echo '<td class="month">';

                $month++;

                // Month Cell

                $first_day_in_month = date('w',mktime(0, 0, 0, $month, 1, $haas_year));
                $month_days=date('t',mktime(0, 0, 0, $month, 1, $haas_year));
                
                if($first_day_in_month == 0) {
                    $first_day_in_month = 7;
                }

                echo '<table>';
                echo '<th colspan="7">'. $months[$month - 1] .'</th>';
                echo '<tr class="days"><td>Mo</td><td>Tu</td><td>We</td><td>Th</td><td>Fr</td>';
                echo '<td class="sat">Sa</td><td class="sun">Su</td></tr>';
                echo '<tr>';

                for($i = 1; $i < $first_day_in_month; $i++) {
                    echo '<td></td>';
                }

                for($day = 1; $day <= $month_days; $day++) {

                    $pos = ($day + $first_day_in_month - 1) % 7;

                    $class = 'day score_';


                    $class .= $horoscopes[$dayCount - 1]->score;

                    echo '<td class="' . $class . '"><div data-toggle="tooltip" title="' . $horoscopes[$dayCount - 1]->prediction . '
">' . $day . '<br><small>(' . $horoscopes[$dayCount - 1]->score . ')</small></div></td>';

                    if($pos == 0)
                        echo '</tr><tr>';

                    $dayCount++;
                }

                echo '</tr>';
                echo '</table><br>';

                echo '</td>';

            }

            echo '</tr>';
        }

        echo '</table>';

    ?>

    <br>
    <hr>
    <br>
    <h4 class="text-center">Monthly Statistics (Sorted By Average Daily Score)</h4>
    <hr>
    <div class="row">
        <div class="col-sm-4">
            <b>Month</b>
        </div>
        <div class="col-sm-4">
            <b>Total Score</b>
        </div>
        <div class="col-sm-4">
            <b>Average Daily Score</b>
        </div>
    </div>
    <hr>

    @foreach($monthly_stats as $monthly_stat)

    <div class="row">
        <div class="col-sm-4">
            {{ $monthly_stat->month }}
        </div>
        <div class="col-sm-4">
            {{ $monthly_stat->total_score }}
        </div>
        <div class="col-sm-4">
            {{ $monthly_stat->score_per_day }}
        </div>
    </div>

    @endforeach

    <br>
    <br>

@stop