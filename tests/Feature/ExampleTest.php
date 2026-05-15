git remote add origin https://github.com/richardjr822/UNITE.git<?php

it('returns a successful response', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});
