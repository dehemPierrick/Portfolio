<?php


class FlashBagFilter implements InterceptingFilter {

    public function run(Http $http, array $queryFields, array $formFields) {
        return [
            'flashbag' => new FlashBag()
        ];
    }
}