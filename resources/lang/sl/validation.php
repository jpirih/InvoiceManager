<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'Polje :attribute mora biti potrjeno.',
    'active_url'           => 'Polje :attribute ni veljaven URL naslov',
    'after'                => 'Polje :attribute mora biti datum kasnejši od :date.',
    'alpha'                => 'Polje :attribute lahko vsebuje le črke.',
    'alpha_dash'           => 'Polje :attribute lahko vsebuje le črke številke in -',
    'alpha_num'            => 'Polje :attribute Lahko vsebuje le črke in številke.',
    'array'                => 'Vnos :attribute mora obvezno biti seznam.',
    'before'               => 'Polje :attribute mora biti datum kasnejši od :date.',
    'between'              => [
        'numeric' => 'Polje :attribute mora vsebovati število med :min in :max.',
        'file'    => 'Polje :attribute mora biti datoteka velika najmanj :min in največ :max kB.',
        'string'  => 'Polje :attribute mora biti besedilo dolgo najmanj :min in največ :max znakov.',
        'array'   => 'Polje :attribute mora vsebovati seznam z najmanj :min in največ :max elementi.',
    ],
    'boolean'              => 'Polje :attribute mora imeti vrednost true ali false.',
    'confirmed'            => 'Polje :attribute Potrditev se ne ujema.',
    'date'                 => 'Polje :attribute ni veljaven datum.',
    'date_format'          => 'Polje :attribute ni pravilno oblikovano :format.',
    'different'            => 'Polje :attribute mora biti različno od :polja.',
    'digits'               => 'Polje :attribute mora vsebovati :digits cifer.',
    'digits_between'       => 'Polje :attribute Mora vsebovati vrednost med :min in :max cifer.',
    'email'                => 'Polje :attribute mora vsebovati veljaven email naslov.',
    'exists'               => 'Izbrano polje :attribute je neveljavno.',
    'filled'               => 'Vnos :attribute polja je obvezen.',
    'image'                => 'Element :attribute mora obvezno biti slika.',
    'in'                   => 'Izbrani element :attribute je neveljaven.',
    'integer'              => 'Polje :attribute mora vsebovati celo število.',
    'ip'                   => 'Polje :attribute mora vsebovati veljaven IP naslov',
    'json'                 => 'Polje :attribute Polje mra vsebovati veljaven JSON.',
    'max'                  => [
        'numeric' => 'Vrednost polja :attribute ne sme presegati :max.',
        'file'    => 'Velikost datoteke :attribute ne sme biti večja od :max kilobytes.',
        'string'  => 'Dolžina stringa  :attribute ne sme biti daljša od :max znakov.',
        'array'   => 'Seznam ne :attribute ne sme vsebovati več kot :max elementov.',
    ],
    'mimes'                => 'Element :attribute mora biti datoteka tipa: :values.',
    'min'                  => [
        'numeric' => 'Vrednost elementa :attribute mora biti najmanj :min.',
        'file'    => 'Datoteka :attribute mora biti velika vsaj :min kB.',
        'string'  => 'Tekst v polju :attribute mora vsebovati vsaj :min znakov.',
        'array'   => 'Seznam :attribute mora vsebovati najmanj :min elementov.',
    ],
    'not_in'               => 'Izbrani element :attribute ni veljaven.',
    'numeric'              => 'Polje :attribute moara vsebovati število.',
    'regex'                => 'Oblika vsebine polja :attribute je nepravilna.',
    'required'             => 'Polje :attribute vnos je obvezen.',
    'required_if'          => 'Polje :attribute vnos polja je obvezen če je v polju:other vrednost :value.',
    'required_unless'      => 'Polje :attribute Vnos polja je obvezen razen če je v polju:other znotraj in :values.',
    'required_with'        => 'Polje :attribute Vnos tega polja je obvezen ker :values .',
    'required_with_all'    => 'Polje :attribute Vnos tega polja je obvezen kadar vrednost :values obstaja.',
    'required_without'     => 'Polje :attribute Vnos tega polja je obvezen če vrednost :values ne obstaja.',
    'required_without_all' => 'Polje :attribute Vnos tega polja je obvezen ker nobena od vrednosi :values ne obstaja.',
    'same'                 => 'Polje :attribute vsebina tega polja se mora obvezno ujemati z vsebino :other polja.',
    'size'                 => [
        'numeric' => 'Element :attribute mora imeti točno :size velikost.',
        'file'    => 'Datoteka :attribute mora biti velikosti :size kb.',
        'string'  => 'Tekst :attribute mora biti  :size znakov dolg.',
        'array'   => 'Seznam :attribute mora vsebovati :size elementov.',
    ],
    'string'               => 'Element :attribute mora obvezno biti tekst.',
    'timezone'             => 'Element :attribute mora vsebovati veljavni časovni pas.',
    'unique'               => ':attribute je že zaseden izberi drugega oz drugo.',
    'url'                  => ' :attribute je nepravilne oblike.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
