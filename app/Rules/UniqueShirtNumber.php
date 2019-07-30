<?php

namespace App\Rules;

use App\Models\Player;
use Illuminate\Contracts\Validation\Rule;

class UniqueShirtNumber implements Rule
{
    protected $playerId;
    protected $teamID;

    /**
     * Create a new rule instance.
     *
     * @param $playerId
     * @param $teamID
     */
    public function __construct($playerId, $teamID)
    {
        $this->playerId = $playerId;
        $this->teamID = $teamID;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $player = Player::find($this->playerId);

        if ($value==$player->shirt_number && $this->teamID==$player->team_id){
            return true;
        } else {
            if (Player::where('shirt_number', $value)->where('team_id', $this->teamID)->first()) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute has already been taken.';
    }
}
