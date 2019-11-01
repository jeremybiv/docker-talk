<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\User;

/**
 * Class Topic
 *
 * @package App
 * @property string $subject
 * @property text $description
 * @property string $email
 * @property string $date
 * @property integer $status
*/
class Topic extends Model
{
    
    protected $fillable = ['subject', 'description', 'email', 'date', 'status','user_id'];
    

    public static function storeValidation($request)
    {
        return [
            'subject' => 'max:80|required',
            'description' => 'max:65535|required',
            'email' => 'email|max:190|required',
            'date' => 'date_format:' . config('app.date_format') . '|max:190|required',
            'status' => 'integer|max:1|nullable'
        ];
    }

    public static function updateValidation($request)
    {
        return [
            'subject' => 'max:80|required',
            'description' => 'max:65535|required',
            'email' => 'email|max:190|required',
            'date' => 'date_format:' . config('app.date_format') . '|max:190|required',
            'status' => 'integer|max:1|nullable'
        ];
    }

    

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setDateAttribute($input)
    {
        if ($input) {
            $this->attributes['date'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        }
    }

    /**
     * Get attribute from date format
     * @param $output
     *
     * @return string
     */
    public function getDateAttribute($output)
    {
        if ($output) {
            return Carbon::createFromFormat('Y-m-d', $output)->format(config('app.date_format'));
        }
    }

    public function scopePublished($query)
    {
        return $query->where('status', 1)::with([]);
    }

    public function scopeNextTalk($query)
    {
        
        return $query->where('date', )::with([]);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
