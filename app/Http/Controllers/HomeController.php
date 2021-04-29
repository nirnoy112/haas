<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Month;
use App\Models\ZodiacSign;
use App\Models\Horoscope;
use App\Models\MonthlyStat;
use App\Models\YearlyStat;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    // Displays home page
    public function index()
    {
        return view('pages.home');
    }

    // Generates Calendar
    public function generateCalendar(Request $request)
    {

    	$haas_year = $request->haas_year;

    	$months = Month::all();
    	$zodiac_signs = ZodiacSign::all();


    	// Deleting existing horoscopes, monthly and yearly statistics of the selected year.
    	Horoscope::where('year', $haas_year)->delete();
    	MonthlyStat::where('year', $haas_year)->delete();
    	YearlyStat::where('year', $haas_year)->delete();

    	foreach ($zodiac_signs as $zodiac_sign) {
    		
    		$yearly_score = 0;
    		$days_in_year = 0;

    		foreach ($months as $month) {
    			
    			$days_in_month = date('t', mktime(0, 0, 0, $month['id'], 1, $haas_year));

    			$monthly_score = 0;
    			
    			for($day = 1; $day <= $days_in_month; $day++) {

    				$score = rand(1, 10);

    				$monthly_score += $score;

    				// Daily horoscore
	    			$horoscope = array(
	    				'year' => $haas_year,
	    				'month_id' => $month['id'],
	    				'day' => $day,
	    				'zodiac_sign_id' => $zodiac_sign['id'],
	    				'score' => $score,
	    				'prediction' => $this->getPrediction($score)
	    			);

	    			Horoscope::create($horoscope);

    			}

    			// Monthly statistics
    			$monthly_stat = array(
    				'year' => $haas_year,
    				'month_id' => $month['id'],
    				'zodiac_sign_id' => $zodiac_sign['id'],
    				'total_score' => $monthly_score,
	    			'score_per_day' => number_format($monthly_score / $days_in_month, 4)
    			);

    			MonthlyStat::create($monthly_stat);

    			$days_in_year += $days_in_month;

    			$yearly_score += $monthly_score;

    		}

    		// Yearly statistics
    		$yearly_stat = array(
				'year' => $haas_year,
				'zodiac_sign_id' => $zodiac_sign['id'],
				'total_score' => $yearly_score,
				'score_per_day' => number_format($yearly_score / $days_in_year, 4)
			);

			YearlyStat::create($yearly_stat);

    	}

    	// Retrieving yearly statistics
    	$yearly_stats = DB::table('yearly_stats')
    						->select('year', 'zodiac_signs.title as zodiac_sign', 'total_score', 'score_per_day')
    						->join('zodiac_signs', 'yearly_stats.zodiac_sign_id', '=', 'zodiac_signs.id')
    						->where('yearly_stats.year', $haas_year)
    						->orderBy('yearly_stats.score_per_day', 'desc')
    						->get();

    	return view('pages.home', compact('haas_year', 'months', 'zodiac_signs', 'yearly_stats'));
    }

    // Displays Calendar
    public function displayCalendar(Request $request)
    {

    	$zodiac_signs = ZodiacSign::all();

    	$haas_year = $request->year;
    	$zodiac_sign_id = $request->zodiac_sign_id;

    	// Retrieving daily horoscope
    	$horoscopes = DB::table('horoscopes')
						->where('year', $haas_year)
						->where('zodiac_sign_id', $zodiac_sign_id)
						->orderBy('id', 'asc')
						->get();

		// Retrieving monthly statistics
		$monthly_stats = DB::table('monthly_stats')
    						->select('year', 'months.title as month', 'total_score', 'score_per_day')
    						->join('months', 'monthly_stats.month_id', '=', 'months.id')
    						->where('monthly_stats.year', $haas_year)
    						->where('zodiac_sign_id', $zodiac_sign_id)
    						->orderBy('monthly_stats.score_per_day', 'desc')
    						->get();

        return view('pages.calendar', compact('haas_year', 'zodiac_sign_id', 'horoscopes', 'zodiac_signs', 'monthly_stats'));
    }


    private function getPrediction($score) {

    	$grade_1_variables_1 = array('amazing', 'awesome', 'enchanting', 'wonderful', 'excellent', 'entertaining');
    	$grade_1_variables_2 = array('charming', 'thrilling', 'lucky', 'fascinating', 'superb', 'pleasant', 'gratifying');
    	$grade_1_variables_3 = array('delightful', 'great', 'good', 'better', 'surprising', 'beneficial', 'pleasing');

    	$grade_1_predictions = array(
    		'An ' . $grade_1_variables_1[rand(0, count($grade_1_variables_1) - 1)] . ' day awaits for you, be grateful to your God for the life you have.',
    		'You seems like to have a ' . $grade_1_variables_2[rand(0, count($grade_1_variables_2) - 1)] . ' day, do not forget to enjoy the day with the people you love.',
    		'Your good energy helps you make the most of the and you may find yourself launching in a new direction quickly.',
    		'Some ' . $grade_1_variables_3[rand(0, count($grade_1_variables_3) - 1)] . ' news comes your way today, probably rather early, but potentially at any time.',
    		'Your boss is in a surprisingly giving mood today. That does not necessarily mean a huge raise, but you can get away with a little more.',
    		'Be patient and passionate because today something will happen this day to make your life better.',
    		'Today is perfect for reconciling differences with loved ones, or even with coworkers -- you are much more willing to let go of ego concerns, and the odds are good that they will be, too!',
    		'It is a lucky day, you will along better than ever with the folks who mean the most to you.',
    		'You can count on support from superiors today -- or bureaucrats or just the powers that be. Someone up there likes you, and you should definitely take advantage of that to make a real difference.',
    		'You are right in the middle of a big win, even if you can nott quite see it for what it is yet. Make sure that you are still feeling right about your people and your surroundings, as you can make changes if you like.',
    		'There is nothing wrong with a little healthy ambition -- and you have got the perfect amount!',
    		'It is a great time to move forward with plans that might not come to fruition for a good long time.',
    		'It is a good day to ease up on anything you have been overdoing lately.'
    	);

    	$grade_2_predictions = array(
    		'Try your best to just roll with the day and whatever it offers.',
    		'Today is perfect for reconciling differences with loved ones, or even with coworkers.',
    		'You are much more willing to let go of ego concerns, and the odds are good that they will be, too!.',
    		'You should do whatever it takes to subdue the urge to fight back today, unless you are up against the wall.',
    		'You are almost certainly much better of approaching the situation from a new angle later on.',
    		'You feel a little strange today -- more so than usual, anyway!',
    		'It might be a good time to take the day off from your usual activities and try to just reconnect with your innermost self.',
    		'Leave the day up to God, you just have to go ahead and see what works and what does not.',
    		'You have got a choice to make today: critical versus creative.',
    		'It is not as simple as it seems, as it may be that someone or something in your life is begging for a critique, but you may want to stay positive.',
    		'If you are feeling restless or otherwise needy, try to find a new way to reconcile yourself to your situation.',
    		'Contentment is at a premium right now, but if you can get there, you should feel much better!',
    		'Try not to worry all that much about your social life -- it should trundle along on its own for the time being.',
    		'You may be somewhat sentimental about old times or old people today, but this is not just light-hearted nostalgia.',
    		'you need to make sure that you are not just acting on instinct. That can pay off for you sometimes, but at the moment, you are just flying blind.'

    	);

    	$grade_3_variables_1 = array('awful', 'horrifying', 'frightful', 'nasty', 'horrible', 'gloomy', 'terrible', 'stressed');
    	$grade_3_variables_2 = array('awaiting', 'close', 'approaching', 'coming', 'ahead');
    	$grade_3_variables_3 = array('damazing', 'dangerous', 'negative', 'hazardous', 'injurious', 'evil', 'detrimental', 'mischievois');
    	$grade_3_variables_4 = array('ugly', 'unpleasant', 'unlucky');

    	$grade_3_predictions = array(
    		'A ' . $grade_3_variables_1[rand(0, count($grade_3_variables_1) - 1)] . ' day is ' . $grade_3_variables_2[rand(0, count($grade_3_variables_2) - 1)] . ' so be safe and away from bad omens.',
    		'Something ' . $grade_3_variables_3[rand(0, count($grade_3_variables_3) - 1)] . ' may happen to you so stay away from unknown persons and things.',
    		'This is a ' . $grade_3_variables_1[rand(0, count($grade_3_variables_1) - 1)] . ' day for you, it is messy, but it gets results for sure!',
    		'It looks like an ' . $grade_3_variables_4[rand(0, count($grade_3_variables_4) - 1)] . ' day is on the way, do not trust unknown people because harm may come that way.',
    		'This is not the right day for you to approach your loved one because things may go wrong in multiple way',
    		'Its an odd day for you socially -- you need to really connect with at least one person, but they may be unusually hard to reach.',
    		'It is trial-and-error day for you -- there is no good way to predict what will happen.',
    		'Bad news comes your way today, probably rather early, but potentially at any time. Your good energy helps you make the most of it and you may find yourself launching in a new direction quickly.',
    		'You find that people are much more likely to miss the point when you are speaking, it might get quite frustrating! See if you can slow down or, better still, spell things out so they can not misunderstand.',
    		'On this day you may find that you are a little stuck in the past, and that is no fun!',
    		'You are heading for burnout if you are not careful! It is not such a bad thing to take the day off and let the chips fall where they may.'

    	);

	    switch($score) {

		    case ($score >= 1 && $score <= 3):
			    return $grade_3_predictions[rand(0, count($grade_3_predictions) - 1)];
			    break;

			case ($score >= 4 && $score <= 7):
			    return $grade_2_predictions[rand(0, count($grade_2_predictions) - 1)];
			    break;

			case ($score >= 8):
			    return $grade_1_predictions[rand(0, count($grade_1_predictions) - 1)];
			    break;

	    }

    }

}
