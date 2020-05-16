
<table border="1" id="tb_class_grade" width="100%" class="table table-striped" style="text-align:center">
	<thead>
		<tr>
			<th style="text-align:center;">Student</th>
			<th>
				<table border="1" width="100%" style="text-align:center">
					<tr>
						<td colspan="6">
							Penilaian Praktik
						</td>
						<td>Rata-rata</td>
					</tr>
					<tr>
						<?php $i = 0; ?>
						<?php for ($i; $i < 3; $i++) { ?>
						<td style="width:50px;"><?php echo $i ?></td>
						<td style="width:50px;">Rem</td>
						<?php } ?>
						<td><?php echo $subject['sas_aw_ppk'] ?>%</td>
					</tr>
				</table>
			</th>
			<th>
				<table border="1" width="100%" style="text-align:center">
					<tr>
						<td colspan="6">
							Penilaian Produk
						</td>
						<td>Rata-rata</td>
					</tr>
					<tr>
						<?php $i = 1; ?>
						<?php for ($i; $i < 4; $i++) { ?>
						<td style="width:50px;"><?php echo $i ?></td>
						<td style="width:50px;">Rem</td>
						<?php } ?>
						<td><?php echo $subject['sas_aw_ppr'] ?>%</td>
					</tr>
				</table>
			</th>
			<th>
				<table border="1" width="100%" style="text-align:center">
					<tr>
						<td colspan="6">
							Penilaian Project
						</td>
						<td>Rata-rata</td>
					</tr>
					<tr>
						<?php $i = 0; ?>
						<?php for ($i; $i < 3; $i++) { ?>
						<td style="width:50px;"><?php echo $i ?></td>
						<td style="width:50px;">Rem</td>
						<?php } ?>
						<td><?php echo $subject['sas_aw_ppj'] ?>%</td>
					</tr>
				</table>
			</th>
			<th>
				<table border="1" width="100%" style="text-align:center">
					<tr>
						<td colspan="2">
							Mid Tst
						</td>
						<td colspan="2">Smst Tst</td>
					</tr>
					<tr>
						<td style="width:50px;">Nilai</td>
						<td style="width:50px;"><?php echo $subject['sas_aw_md'] ?>%</td>
						<td style="width:50px;">Nilai</td>
						<td style="width:50px;"><?php echo $subject['sas_aw_st'] ?>%</td>
					</tr>
				</table>
			</th>
			<th>
				Nilai Akhir
			</th>
			<th>
				Konversi
			</th>
			<th>
				Predikat
			</th>
			<th>
				Remark
			</th>
		</tr>
	</thead>
	<tbody>
		<?php $alpha = ['a','b','c','d','e']; ?>
		<?php foreach ($skill as $item) { ?>
		<tr>
			<td style="padding-left:100px;padding-right:100px;">
				<?php echo $item->student_name ?>
			</td>
			<td>
				<table width="100%" style="text-align:center">
					<tr>
						<?php $i = 0 ?>
						<?php for ($i; $i < 3; $i++) { ?>
						<td><input style="width:50px;" value="<?php echo $item->{'ssg_ppk_'.$alpha[$i]} ; ?>"  type="number" name="ssg_ppk<?php echo $item->student_id?>[]"></td>
						<td><input style="width:50px;" value="<?php echo $item->{'ssg_ppk_rem'.$alpha[$i]} ; ?>" type="number" name="ssg_ppk_rem<?php echo $item->student_id?>[]"></td>
						<?php } ?>
						<td><input readonly type="number" value="<?php echo $item->ssg_avg_ppk ; ?>" name="ssg_avg_ppk<?php echo $item->student_id?>"></td>
					</tr>
				</table>
			</td>
			<td>
				<table width="100%" style="text-align:center">
					<tr>
						<?php $i = 0; ?>
						<?php for ($i; $i < 3; $i++) { ?>
						<td><input style="width:50px;" value="<?php echo $item->{'ssg_ppr_'.$alpha[$i]} ; ?>" type="number" name="ssg_ppr<?php echo $item->student_id?>[]"></td>
						<td><input style="width:50px;" type="number" value="<?php echo $item->{'ssg_ppr_rem'.$alpha[$i]} ; ?>" name="ssg_ppr_rem<?php echo $item->student_id?>[]"></td>
						<?php } ?>
						<td><input readonly type="number" value="<?php echo $item->ssg_avg_ppr ; ?>" name="ssg_avg_ppr<?php echo $item->student_id?>"></td>
					</tr>
				</table>
			</td>
			<td>
				<table width="100%" style="text-align:center">
					<tr>
						<?php $i = 0; ?>
						<?php for ($i; $i < 3; $i++) { ?>
						<td><input style="width:50px;" type="number" value="<?php echo $item->{'ssg_ppj_'.$alpha[$i]} ; ?>" name="ssg_ppj<?php echo $item->student_id?>[]"></td>
						<td><input style="width:50px;" type="number" value="<?php echo $item->{'ssg_ppj_rem'.$alpha[$i]} ; ?>" name="ssg_ppj_rem<?php echo $item->student_id?>[]"></td>
						<?php } ?>
						<td><input readonly type="number" value="<?php echo $item->ssg_avg_ppj ; ?>" name="ssg_avg_ppj<?php echo $item->student_id?>"></td>
					</tr>
				</table>
			</td>
			<td>
				<table width="100%" style="text-align:center">
					<tr>
						<td><input style="width:50px;" value="<?php echo $item->ssg_md_score ; ?>" type="number" name="ssg_md<?php echo $item->student_id?>"></td>
						<td><input style="width:50px;" value="<?php echo $item->ssg_avg_md ; ?>" readonly type="number" name="ssg_avg_md<?php echo $item->student_id?>"></td>
						<td><input style="width:50px;" value="<?php echo $item->ssg_st_score ; ?>" type="number" name="ssg_st<?php echo $item->student_id?>"></td>
						<td><input style="width:50px;" value="<?php echo $item->ssg_avg_st ; ?>" readonly type="number" name="ssg_avg_st<?php echo $item->student_id?>"></td>
					</tr>
				</table>
			</td>
			<td>
				<table width="100%" style="text-align:center">
					<tr>
						<td><input style="width:50px;" value="<?php echo $item->ssg_final_score ; ?>" readonly type="number" name="ssg_final_score<?php echo $item->student_id?>"></td>
					</tr>
				</table>
			</td>
			<td>
				<table width="100%" style="text-align:center">
					<tr>
						<td><input style="width:50px;" readonly value="<?php echo $item->ssg_conversion ; ?>" type="number" name="ssg_conversion<?php echo $item->student_id?>"></td>
					</tr>
				</table>
			</td>
			<td>
				<table width="100%" style="text-align:center">
					<tr>
						<td><input style="width:50px;" readonly value="<?php echo $item->ssg_predikat ; ?>" type="text" name="ssg_predikat<?php echo $item->student_id?>"></td>
					</tr>
				</table>
			</td>
			<td>
				<input type="text" style="width:250px" value="<?php echo $item->ssg_remark ; ?>" name="ssg_remark<?php echo $item->student_id?>">
			</td>
		</tr>
		<?php }; ?>
	</tbody>
</table>
