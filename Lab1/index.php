<?php
 echo "Sofiia Koval, SA2, Lab1, V1";
//1.Описати літерал нумерованого масиву із 5 -7 масивів з текстовими ключами, що містять дані про об'єкти згідно із варіантом.
//2.Вивести дані про об'єкти в таблицю.
//3.Підготувати функцію для вибору всіх елементів масиву, що відповідають запиту. Вивести їх в таблицю.
//4.Передбачити можливість передачі параметрів запиту через рядок стану (наприклад index.php?country=ukraine&min_age=18)
//5.Створити форму для додавання нового об'єкту до масиву.
//6.(як змінювати дані у оригінальному масиві?) Створити форму редагування даних про об'єкт.
//7. Перед редагуванням здійснити валідацію даних (ПІБ не може бути порожнім рядком, заробітна плата повинна бути невід'ємним числом, тощо).

//1. Асоціативний масив “Бухгалтерія” (Код, ПІБ; посада; заробітна плата; кількість дітей; стаж).
// Запит працюючих, які обіймають посаду Х і мають не більше, ніж Y дітей.

$error_message = null;

$financeDepartment = [
    'code' => null,
    'fullName' => null,
    'position' => null,
    'salary' => null,
    'childrenAmount' => null,
    'workExperience' => null
];

$financeDepartments = [
    [
    'code' => 1,
    'fullName' => 'Corina Holland',
    'position' => 'Payroll Clerk',
    'salary' => 600,
    'childrenAmount' => 1,
    'workExperience' => 1.5
    ],
    [
        'code' => 2,
        'fullName' => 'Bill Hoover',
        'position' => 'Junior Financial Analyst',
        'salary' => 450,
        'childrenAmount' => 0,
        'workExperience' => 1
    ],
    [
        'code' => 3,
        'fullName' => 'Herbert Strickland',
        'position' => 'Financial Advisor Assistant',
        'salary' => 1575,
        'childrenAmount' => 3,
        'workExperience' => 8
    ],
    [
        'code' => 4,
        'fullName' => 'Becky Malone',
        'position' => 'Finance Manager',
        'salary' => 1330,
        'childrenAmount' => 2,
        'workExperience' => 11
    ],
    [
        'code' => 5,
        'fullName' => 'Laverne Lucero',
        'position' => 'Economist',
        'salary' => 395,
        'childrenAmount' => 0,
        'workExperience' => 0.5
    ],
    [
        'code' => 6,
        'fullName' => 'Emory Howe',
        'position' => 'Budget Analyst',
        'salary' => 620,
        'childrenAmount' => 0,
        'workExperience' => 4
    ],
    [
        'code' => 7,
        'fullName' => 'Eunice Blanchard',
        'position' => 'Senior Finance Analyst',
        'salary' => 1165,
        'childrenAmount' => 3,
        'workExperience' => 6
    ]
];

//added correct form for changes in array
if(isset($_POST['editCode'])){
    $editKey = null;
    foreach($financeDepartments as $key => $value){
        if ($value['code'] == $_POST['editCode']){
            $editKey = $key;
            break;
        }
    }
    if (!is_null($editKey) && !empty($_POST['editFullName']) && !empty($_POST['editPosition']) && !empty($_POST['editSalary']) && $_POST['editSalary'] > 0 && !empty($_POST['editChildrenAmount']) && !empty($_POST['editWorkExperience'])) {
        $financeDepartments[$editKey] = array_merge($financeDepartments[$editKey],  [
            'fullName' => $_POST['editFullName'] ?? '',
            'position' => $_POST['editPosition'] ?? '',
            'salary' => $_POST['editSalary'] ?? '',
            'childrenAmount' => $_POST['editChildrenAmount'] ?? '',
            'workExperience' => $_POST['editWorkExperience'] ?? '',
        ]);
    }
    else{
        $error_message =  "Not found or something is empty.";
    }
}
//=====================================
if(isset($_POST['code'])){
    $financeDepartments[] = [
        'code' => $_POST['code'] ?? '',
        'fullName' => $_POST['fullName'] ?? '',
        'position' => $_POST['position'] ?? '',
        'salary' => $_POST['salary'] ?? '',
        'childrenAmount' => $_POST['childrenAmount'] ?? '',
        'workExperience' => $_POST['workExperience'] ?? '',
    ];
}

$financeDepartments = array_filter($financeDepartments, function ($element){
   $return_flag = true;
   if(isset($_GET['position'])&&$element!= $_GET['position']){
       $return_flag = false;
   }
   if($return_flag && isset($_GET['childrenAmount']) && $element['childrenAmount'] >= $_GET['childrenAmount']){
       $return_flag=false;
   }
   return $return_flag;
});

include 'templates/finDeptTable.phtml';
include 'templates/finDeptCreateForm.phtml';
include 'templates/finDeptChangeForm.phtml';

if ($error_message ){
    print $error_message;
}