<?php

$TypoScript['mypage'] = 'PAGE';
$TypoScript['mypage.']['typeNum'] = 0;
$TypoScript['mypage.']['10'] = 'TEXT';
$TypoScript['mypage.']['10.']['value'] = 'This is rendered first.';
$TypoScript['mypage.']['20'] = 'TEXT';
$TypoScript['mypage.']['20.']['value'] = 'This is rendered in the middle.';
$TypoScript['mypage.']['30'] = 'TEXT';
$TypoScript['mypage.']['30.']['value'] = 'This gets rendered last.';

$TypoScript['print'] = 'PAGE';
$TypoScript['print.']['typeNum'] = 98;
$TypoScript['print.']['10'] = 'TEXT';
$TypoScript['print.']['10.']['value'] = 'This is the print version.';
