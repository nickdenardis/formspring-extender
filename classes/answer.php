<?php
class Answer extends ActiveRecord {
	function __construct(){
		// Call the parent constructor
		parent::__construct('answers', DB_DEFAULT);
		
		// Set the relationships
		$this->HasMany('Category', 'AnswerCategory');
		
		// Set the Required
		$this->SetRequired(array('user_id', 'question_id', 'question', 'answer', 'date_asked'));
	}
	
	public function GetRecentAnswers($user_id){
		global $myUser;
		
		// Get the last question in the DB for this user
		$this->ResetValues();
		$this->SetValue('user_id', $user_id);
		$last_question = current($this->GetAssoc('question_id', 'question_id', 'DESC', 0, 1));
		
		// Start the API connection
		$connection = new FormspringOAuth(CONSUMER_KEY, CONSUMER_SECRET,
											$myUser->GetValue('oauth_token'), $myUser->GetValue('oauth_token_secret'));
											
		// Grab new items in the inbox
		$inbox = $connection->get('answered/list/' . $myUser->GetValue('username'), array('since_id' => (int)$last_question));
		$max_id = 0;
		$total_imported = 0;
		
		do {
			// If we have to get older items
			if ($max_id != 0)
				$inbox = $connection->get('answered/list/' . $myUser->GetValue('username'), array('max_id' => $max_id));
			
			// Loop through and make sure the questions are in the database
			if (is_array($inbox->response))
				foreach ($inbox->response as $answer){	
					if ($answer->id > (int)$last_question){
						// Set all the values for the database
						$this->ResetValues();
						$this->SetValue('question_id', $answer->id);
						$this->SetValue('question', $answer->question);
						$this->SetValue('answer', $answer->answer);
						$this->SetValue('date_asked',  date('Y-m-d H:i:s', strtotime($answer->time)));
						$this->SetValue('user_id',  $myUser->GetPrimary());

						// Save the new answer
						if (!$this->Save())
							throw new SimplException('Error saving answer to database', 2, 'Error: Saving answer to database: ' . $answer->id);
						
						$total_imported++;
					}
					$max_id = $answer->id;
				}
		}while ($max_id != 0 && is_array($inbox->response) && count($inbox->response) > 0);
		
		
		return $total_imported;
	}
}
?>