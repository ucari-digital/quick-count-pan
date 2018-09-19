<?php
namespace App\Helper;
use Carbon\Carbon;
use DateTime;
class TimeFormat
{
	private $time;

	public function date($time)
	{
		$this->time = $time;
		return $this;
	}

	public function toFormat($format, $sparator = '-')
	{
		$time = $this->time;
		if ($format == 'id') {
			$tahun = substr($time, 0, 4);
			$bulan = substr($time, 5, 2);
			$tanggal = substr($time, 8, 2);

			return $tanggal.$sparator.$bulan.$sparator.$tahun;
		}

		if ($format == 'sys') {
			$tahun = substr($time, 6, 4);
			$bulan = substr($time, 3, 2);
			$tanggal = substr($time, 0, 2);

			return $tahun.$sparator.$bulan.$sparator.$tanggal;
		}
	}

	public static function id($time)
	{
		$self = new self;
		$self->date($time);
		return $self->toFormat('id');
	}

	// Age based Date of birth
	public static function age($date)
	{
		$from = new DateTime($date);
		$to   = new DateTime('today');
		return $from->diff($to)->y;
	}
}