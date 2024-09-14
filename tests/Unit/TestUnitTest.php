<?php

use Application\Test;

describe('Test', function () {
    beforeEach(function() {
        $this->testClass = new Test();
    });

    it('Should return correctly Hello World message', function(){
        expect($this->testClass->execute())->toEqual("Hello World");
    });
});