<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\ImplicitRule;

class ValidateCheckbox implements ImplicitRule
{
    /**
     * The source control provider instance.
     *
     * @var \App\Source
     */
    public $source;
    /**
     * The branch name.
     *
     * @var string
     */
    public $branch;
    /**
     * Create a new rule instance.
     *
     * @param  \App\Source  $source
     * @param  string  $branch
     * @return void
     */
    public function __construct( $source )
    {
        echo '<pre>File: ' . __FILE__ . '<br>Line: ' . __LINE__    . '<br>';
        print_r( $source );
        echo '<pre>'; die;
        $this->source = $source;
        $this->branch = $branch;
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
        if (! $this->source instanceof Source) {
            return false;
        }
        return $this->source->client()->validRepository(
            $value, $this->branch
        );
    }
    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The given repository is invalid.';
    }
}