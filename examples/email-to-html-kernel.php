<?php
declare(strict_types=1);

use Cundd\Processor\Processor;

/**
 * A simple kernel that reads an email from STDIN and converts it into HTML
 */

/**
 * The input data
 *
 * @var string[] $data
 */

$processor = new Processor();

$state = new stdClass();
$state->previousLineWasEmpty = false;

$processor
    // Skip the email headers -> search until an empty line was found
    ->process('collection.filter', function (string $line) use (&$state) {
        if ("\n" === $line) {
            $state->previousLineWasEmpty = true;

            return false;
        }

        return $state->previousLineWasEmpty;
    })
    // Concatenate the lines into a string
    ->process('implode')
    // Decode the Quoted-printable string (https://en.wikipedia.org/wiki/Quoted-printable)
    ->process('function', fn(string $line) => quoted_printable_decode($line))
    // Output the result to STDOUT
    ->process('io.print');

$processor->run($data);
