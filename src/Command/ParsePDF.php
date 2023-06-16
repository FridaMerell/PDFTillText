<?php

namespace App\Command;

use SimpleXMLElement;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:parse')]
class ParsePDF extends Command {
	function execute(InputInterface $input, OutputInterface $output): int {
		$dirList = scandir('C:\\projects\\kultur\\pdf');
		$pdfList = [];
		foreach ($dirList as $item) {
			if (is_file('C:\\projects\\kultur\\pdf\\' . $item))
				$pdfList[] = 'C:\\projects\\kultur\\pdf\\' . $item;
		}
		$simpleXml = new SimpleXMLElement('<xml/>');

		$simpleXml->addChild('file', base64_encode(file_get_contents($pdfList[0])));
		print $simpleXml->asXML();
		return Command::SUCCESS;
	}

}