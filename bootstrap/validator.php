<?php

function shouldBeInt($value) {
    if (!is_numeric($value)) {
        throw new Exception("Значение '$value' должно быть целочисленным.");
    }
}

function shouldBeInArray($value, $array, $message = null) {
    if (!in_array($value, $array)) {
        throw new Exception($message ? $message : "Значение '$value' должно входить в массив.");
    }
}

function shouldBeGrater($value, $number) {
    if ($value <= $number) {
        throw new Exception("Значение '$value' должно быть больше $number.");
    }
}

function shouldBeFilled($value, $message = null) {
    if (empty($value)) {
        throw new Exception($message ? $message : "Значение '$value' должно быть заполненным.");
    }
}

function shouldBeAdmin() {
    if (!isset($_SESSION['login'])) {
        header('Location: ' . url('/admin'));
        exit(0);
    }
}
