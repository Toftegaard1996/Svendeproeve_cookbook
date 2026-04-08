<?php

namespace App\Lib;

use Gotenberg\Gotenberg;
use Gotenberg\Stream;
use Illuminate\Http\Response;
use Psr\Http\Message\ResponseInterface;

class Pdf
{
    public static function render(string $html, string $imageName): ResponseInterface
    {
        if ($imageName == '') {
            $imageName = 'background2.webp';
        }
        $pdf = Gotenberg::chromium("http://gotenberg:3000")
            ->pdf()
            ->paperSize(8.27, 11.7)
            ->assets(Stream::path(public_path('pdfImg/clock.svg')))
            ->assets(Stream::path(public_path('img/' . $imageName)))
            ->html(Stream::string('recipe.pdf', $html));

        return Gotenberg::send($pdf);
    }

    public static function response(ResponseInterface $response, string $filename): Response
    {
        return response($response->getBody(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $filename . '.pdf"'
        ]);
    }

    public static function nameConversion(string $name): string
    {
        $splitName = explode(' ', $name);
        $combinedName = "";
        foreach ($splitName as $item) {
            $combinedName .= $item . '_';
        }
        return rtrim($combinedName, '_');
    }

}
