<?php

return [
    'custom' => [
        'name' => [
            'required' => 'İsminizi Girmediniz!',
            'string' => 'İsminiz metinden oluşmalıdır!',
            'max' => 'İsminizin bu kadar uzun olmadığına eminiz!'
        ],
        'email' => [
            'required' => 'Email Adresinizi Girmediniz!',
            'email' => 'Girdiğiniz Email Geçersiz!',
            'unique' => 'Bu Email Sitemizde Kayıtlı!'
        ],
        'password' => [
            'required' => 'Parolanızı Girmediniz!',
            'min' => 'Parolanız 6 Karakterden Uzun Olmalıdır!',
            'confirmed' => 'Parolalarınız Eşleşmelidir!'
        ],
        'school' => [
            'required' => 'Okulunuzu Girmediniz!'
        ],
        'class' => [
            'required' => 'Sınıfınızı Girmediniz!',
        ],
        'cost' => [
            'required' => 'Ücretinizi Girmediniz!',
            'numeric' => 'Ücret Bir Sayı Olmalıdır!',
            'min' => 'Ücretinizin saatlik 50TL\'den Az Olmamasını Rica Ediyoruz!'
        ],
        'content' => [
            'required' => 'Mesajınızı Girmediniz!'
        ]
    ],

    'attributes' => [
        'name' => 'İsim',
        'password' => 'parola',
        'school' => 'okul',
        'class' => 'sınıf',
        'cost' => 'ücret'
    ],
];