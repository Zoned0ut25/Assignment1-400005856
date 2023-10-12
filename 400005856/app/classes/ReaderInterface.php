<?php

interface Reader {
    public function find(string $tablename, array $ids) : array;

    public function findall(string $tablename) : array;
}