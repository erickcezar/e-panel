<?php

	include_once dirname(__FILE__) . '/' . 'authorization.php';

	function getSQLValueID($page, $SQL)
	{
		$r = $page->GetConnection()->ExecScalarSQL($SQL);
		return intval($r);

	}

	function validatePassword($page, $fieldname, $password)
	{
		$msg = '';
		$row = array();
		$SQL = 'SELECT * FROM config WHERE id = 1 LIMIT 1';
		$page->GetConnection()->ExecQueryToArray($SQL, $row);
		$row = $row[0];
		
		$conf_password_min_length			= $row['conf_password_min_length'];				
		$conf_password_max_length			= $row['conf_password_max_length'];
		$conf_password_min_upper_case_chars	= $row['conf_password_min_upper_case_chars'];
		$conf_password_min_lower_case_chars	= $row['conf_password_min_lower_case_chars'];
		$conf_password_min_numeric_chars	= $row['conf_password_min_numeric_chars'];
		$conf_password_min_digits_or_puncs	= $row['conf_password_min_digits_or_puncs'];
		$conf_password_min_punctuation_chars= $row['conf_password_min_punctuation_chars'];
		$conf_password_min_age				= $row['conf_password_min_age'];
		$conf_password_max_age				= $row['conf_password_max_age'];
	
		if (empty($password)) {
			$msg = 'Informe a senha!';
			
			if ($fieldname == 'preauth_authentication') {
				$msg = 'Informe a senha de autenticação Auth ESWEB';
			} elseif ($fieldname == 'zimbra_authentication') {
				$msg = 'Informe a senha de autenticação Auth Zimbra';
			}
		} elseif (strlen($password) < $conf_password_min_length) {
			$msg = sprintf('A nova senha precisa ter o tamanho mínimo de %s caracter(es).',
				$conf_password_min_length);
		} elseif (strlen($password) > $conf_password_max_length) {
			$msg = sprintf('A nova senha não pode ultrapassar o tamanho de %s caracter(es).',
				$conf_password_max_length);
		} elseif (preg_match_all('/[A-Z]/', $password) < $conf_password_min_upper_case_chars) {
			$msg = sprintf('A nova senha precisa ter no mínimo %s caracter(es) em maiúsculo.',
				$conf_password_min_upper_case_chars);
		} elseif (preg_match_all('/[a-z]/', $password) < $conf_password_min_lower_case_chars) {
			$msg = sprintf('A nova senha precisa ter no mínimo %s caracter(es) em minúsculo.',
				$conf_password_min_lower_case_chars);
		} elseif (preg_match_all('/[0-9]/', $password) < $conf_password_min_numeric_chars) {
			$msg = sprintf('A nova senha precisa ter no mínimo %s caracter(es) numérico(s).',
				$conf_password_min_numeric_chars);
		} elseif (preg_match_all('/[^a-zA-Z]/', $password) < $conf_password_min_digits_or_puncs) {
			$msg = sprintf('A nova senha precisa ter no mínimo %s caracter(es) númerico(s) ou símbolo(s).',
				$conf_password_min_digits_or_puncs);
		} elseif (preg_match_all('/[^a-zA-Z0-9]/', $password) < $conf_password_min_punctuation_chars) {
			$msg = sprintf('A nova senha precisa ter no mínimo %s símbolo(s).',
				$conf_password_min_punctuation_chars);
		}

		return $msg;
	}
