<?php
interface ValidationRule
{
    public function validate(?string $data): ?bool;
    public function format(?string $data): ?string;
}