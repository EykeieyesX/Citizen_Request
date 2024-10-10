<?php
// Load the file document
$file = file_get_contents('faq.txt');

// Create an array to store the FAQs
$faqs = array();

// Loop through the file and extract the FAQs
$lines = explode("\n", $file);
for ($i = 0; $i < count($lines); $i++) {
    // Check if the line starts with a question
    if (strpos($lines[$i], 'Q:') === 0) {
        // Extract the question
        $question = trim(substr($lines[$i], 2));
        $answer = '';

        // Collect all answers that follow the question
        $answers = [];
        while (isset($lines[$i + 1]) && strpos($lines[$i + 1], 'A:') === 0) {
            $answers[] = trim(substr($lines[$i + 1], 2));
            $i++; // Move to the next line
        }

        // Format the answers as a bullet list with a specific class
        if (!empty($answers)) {
            $answer = '<ul class="faq-answers">' . implode('', array_map(fn($a) => "<li>$a</li>", $answers)) . '</ul>';
        }

        // Add the FAQ to the array
        $faqs[] = array('question' => $question, 'answer' => $answer);
    }
}

// Output the FAQs as JSON
header('Content-Type: application/json');
echo json_encode($faqs);
?>
