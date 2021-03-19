<?php
interface ValidationRule
{
    public function validate(?string $data): ?bool;
}