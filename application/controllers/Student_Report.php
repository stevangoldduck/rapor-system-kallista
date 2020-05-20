<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Student_Report extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->helper(array('url', 'date'));

		$this->load->library(array('template', 'form_validation', 'pdf'));

		$this->load->model(array("user_model", "student_model", "grade_submission_model"));

		if ($this->user_model->isNotAuthenticated()) redirect(site_url('/'));
	}

	public function index()
	{
		$data = new Student_model();
		$students = $data->getList();
		$this->template->set('title', 'Student Report | Dashboard');
		$this->template->load('app', 'contents', 'student_report/index.php', ['students' => $students]);
		//$this->template->push_js('push_js', 'student_report/scripts/datatable.php');
	}

	public function list_student()
	{
		$student = new Student_model();
		return $student->getAll();
	}

	public function generate_student()
	{ 
		$type = $this->input->post('raport_type');
		$student_id = $this->input->post('student_id');
		$ac_year = $this->input->post('ac_year');

		$data = new Grade_Submission_model();

		if($type == "1")
		{
			
			$this->midterm_pdf((int)$student_id,$ac_year,$data->student_mid_raport($student_id,$ac_year));
		}
		else{
			echo "S";
		}
	}

	protected function midterm_pdf($student_id,$ac_year,$data_grade)
	{

		$data = new Student_model();
		$student = $data->findStudentClassNow($student_id);

		$pdf = new FPDF('P', 'mm', 'A4');
		$pdf->SetTitle("Student Raport");

		// membuat halaman baru
		$pdf->AddPage();
		// setting jenis font yang akan digunakan
		$pdf->SetFont('Arial', 'B', 16);
		// mencetak string 
		$pdf->Cell(190, 7, 'FIRST SEMESTER MIDTERM REPORT CARD', 0, 1, 'C');
		$pdf->SetFont('Arial', 'B', 12);
		$pdf->Cell(190, 7, 'SY '.$ac_year, 0, 1, 'C');

		// Memberikan space kebawah agar tidak terlalu rapat
		$pdf->Cell(10, 7, '', 0, 1);
		$pdf->SetFont('Arial', 'B', 10);

		$left_label = ["Department", "Address", "Name", "SN/NISN", "Grade"];
		$data_student = [
			$student["department_name"],
			$student["student_address"],
			$student["student_name"],
			$student["student_nis"]."/".$student["student_nisn"],
			$student["class_grade"]
		];
		foreach ($left_label as $key => $item) {
			$pdf->Cell(25, 6, $item, 0, 0);
			$pdf->Cell(10, 6, ":", 0, 0);
			$pdf->Cell(85, 6, $data_student[$key], 0, 1);
		}

		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(10, 7, '', 0, 1);
		$pdf->Cell(50, 7, 'A. KNOWLEDGE');
		$pdf->Cell(10, 7, '', 0, 1);


		$pdf->SetFont('Arial', 'B', 10);

		$pdf->Cell(10, 15, 'No', 1, 0, 'C');
		$pdf->Cell(50, 15, 'Subject', 1, 0, 'C');
		$pdf->Cell(10, 15, 'SCC', 1, 0, 'C');
		$pdf->Cell(120, 8, 'Knowledge', 1, 0, 'C');

		$pdf->SetXY(($pdf->GetX() - 120), ($pdf->GetY() + 8));
		$pdf->Cell(15, 7, 'Mark ', 1, 0, 'C');

		$pdf->SetXY(($pdf->GetX()), ($pdf->GetY()));
		$pdf->Cell(15, 7, 'Grade ', 1, 0, 'C');

		$pdf->SetXY(($pdf->GetX()), ($pdf->GetY()));
		$pdf->Cell(15, 7, 'Symbol ', 1, 0, 'C');

		$pdf->SetXY(($pdf->GetX()), ($pdf->GetY()));
		$pdf->MultiCell(75, 7, 'Remarks ', 1, 'C');

		// row
		$pdf->SetFont('Arial', '', 10);
		foreach($data_grade as $key => $item)
		{
			$pdf->Cell(10, 15, ++$key, 1, 0, 'C');
			$pdf->Cell(50, 15, $item->subject_name, 1, 0, 'C');
			$pdf->Cell(10, 15, $item->subject_scc, 1, 0, 'C');
			$pdf->Cell(15, 15, $item->skg_final_score, 1, 0, 'C');
			$pdf->Cell(15, 15, ' ', 1, 0, 'C');
			$pdf->Cell(15, 15, $item->skg_predikat, 1, 0, 'C');
			$pdf->MultiCell(75, 15, $item->skg_remark, 1, 'C');
		}


		// membuat halaman baru
		$pdf->AddPage();
		
		$left_label = ["Department", "Address", "Name", "SN/NISN", "Grade"];
		$data_student = [
			$student["department_name"],
			$student["student_address"],
			$student["student_name"],
			$student["student_nis"]."/".$student["student_nisn"],
			$student["class_grade"]
		];
		foreach ($left_label as $key => $item) {
			$pdf->Cell(25, 6, $item, 0, 0);
			$pdf->Cell(10, 6, ":", 0, 0);
			$pdf->Cell(85, 6, $data_student[$key], 0, 1);
		}

		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(10, 7, '', 0, 1);
		$pdf->Cell(50, 7, 'B. SKILLS');
		$pdf->Cell(10, 7, '', 0, 1);


		$pdf->SetFont('Arial', 'B', 10);

		$pdf->Cell(10, 15, 'No', 1, 0, 'C');
		$pdf->Cell(50, 15, 'Subject', 1, 0, 'C');
		$pdf->Cell(10, 15, 'SCC', 1, 0, 'C');
		$pdf->Cell(120, 8, 'Knowledge', 1, 0, 'C');

		$pdf->SetXY(($pdf->GetX() - 120), ($pdf->GetY() + 8));
		$pdf->Cell(15, 7, 'Mark ', 1, 0, 'C');

		$pdf->SetXY(($pdf->GetX()), ($pdf->GetY()));
		$pdf->Cell(15, 7, 'Grade ', 1, 0, 'C');

		$pdf->SetXY(($pdf->GetX()), ($pdf->GetY()));
		$pdf->Cell(15, 7, 'Symbol ', 1, 0, 'C');

		$pdf->SetXY(($pdf->GetX()), ($pdf->GetY()));
		$pdf->MultiCell(75, 7, 'Remarks ', 1, 'C');

		// row
		$pdf->SetFont('Arial', '', 10);
		foreach($data_grade as $key => $item)
		{
			$pdf->Cell(10, 15, ++$key, 1, 0, 'C');
			$pdf->Cell(50, 15, $item->subject_name, 1, 0, 'C');
			$pdf->Cell(10, 15, $item->subject_scc, 1, 0, 'C');
			$pdf->Cell(15, 15, $item->ssg_final_score, 1, 0, 'C');
			$pdf->Cell(15, 15, ' ', 1, 0, 'C');
			$pdf->Cell(15, 15, $item->ssg_predikat, 1, 0, 'C');
			$pdf->MultiCell(75, 15, $item->ssg_remark, 1, 'C');
		}
		
		$pdf->Output();
	}
}
