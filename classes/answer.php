<?php
class Answer extends ActiveRecord {
	function __construct(){
		// Call the parent constructor
		parent::__construct('answers', DB_DEFAULT);
		
		// Set the relationships
		$this->HasMany('Category', 'AnswerCategory');
		
		// Set the Required
		$this->SetRequired(array('user_id', 'question_id', 'question', 'date_asked'));
	}
	
	public function SyncCategories($categories){
		
	}
	
	public function Respond(){
		global $myUser;
		$return = false;
		
		// Ensure there is a question_id and an answer
		if ($this->GetValue('question_id') == '')
			$this-SetError('question_id', 'A question ID is required');
			
		if ($this->GetValue('answer') == '')
			$this-SetError('answer', 'An answer is required');

		if (!$this->IsError()){
			// Start the API connection
			$connection = new FormspringOAuth(CONSUMER_KEY, CONSUMER_SECRET,
											$myUser->GetValue('oauth_token'), $myUser->GetValue('oauth_token_secret'));
		
			$response = $connection->post('inbox/respond/' . ltrim($this->GetValue('question_id'), '0'), array('response' => $this->GetValue('answer')));
			$return = ($response->status == 'ok');
		}
		
		return $return;
	}
	
	public function GetRecentQuestions($user_id){
		global $myUser;
		$added = array();
		
		// Get the last question in the DB for this user
		$this->ResetValues();
		$this->SetValue('user_id', $user_id);
		$this->SetConditions('`answer` = \'\'');
		$last_question = current($this->GetAssoc('question_id', 'question_id', 'DESC', 0, 1));
		if ((int)$last_question < 1)
			$last_question = 1;
		
		// Start the API connection
		$connection = new FormspringOAuth(CONSUMER_KEY, CONSUMER_SECRET,
											$myUser->GetValue('oauth_token'), $myUser->GetValue('oauth_token_secret'));
											
		// Grab new items in the inbox
		$inbox = $connection->get('inbox/list/' . $myUser->GetValue('username'), array('since_id' => ltrim($last_question, '0')));
		$max_id = 0;
		$total_imported = 0;
		
		do {
			// If we have to get older items
			if ($max_id != 0)
				$inbox = $connection->get('inbox/list/' . $myUser->GetValue('username'), array('max_id' => $max_id));
			
			// Loop through and make sure the questions are in the database
			if (is_array($inbox->response))
				foreach ($inbox->response as $answer){	
					if ($answer->id > $last_question && !in_array($answer->id, $added)){
						// Set all the values for the database
						$this->ResetValues();
						$this->SetValue('question_id', str_pad($answer->id, 24, '0', STR_PAD_LEFT));
						$this->SetValue('question', $answer->question);
						$this->SetValue('date_asked',  date('Y-m-d H:i:s', strtotime($answer->time)));
						$this->SetValue('user_id',  $myUser->GetPrimary());
		
						// Save the new answer
						if (!$this->Save())
							throw new SimplException('Error saving answer to database', 2, 'Error: Saving answer to database: ' . $answer->id);
						
						$added[] = $answer->id;
						$total_imported++;
					}
					$max_id = $answer->id;
					
					// Safety - Remove eventually
					if ($total_imported == 10)
						die();
				}
		}while ($max_id != 0 && is_array($inbox->response) && count($inbox->response) > 0);
		
		return $total_imported;
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
		$inbox = $connection->get('answered/list/' . $myUser->GetValue('username'), array('since_id' => ltrim($last_question, '0')));
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
						$this->SetValue('question_id', str_pad($answer->id, 24, '0', STR_PAD_LEFT));
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