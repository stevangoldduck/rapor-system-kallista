
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
						<?php $i = 1; ?>
						<?php for ($i; $i < 4; $i++) { ?>
						<td style="width:50px;"><?php echo $i ?></td>
						<td style="width:50px;">Rem</td>
						<?php } ?>
						<td>50%</td>
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
						<td>50%</td>
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
						<?php $i = 1; ?>
						<?php for ($i; $i < 4; $i++) { ?>
						<td style="width:50px;"><?php echo $i ?></td>
						<td style="width:50px;">Rem</td>
						<?php } ?>
						<td>50%</td>
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
						<td style="width:50px;">##</td>
						<td style="width:50px;">Nilai</td>
						<td style="width:50px;">##</td>
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
		<?php foreach ($student as $item) { ?>
		<tr>
			<td style="padding-left:100px;padding-right:100px;">
				<?php echo $item->student_name ?>
			</td>
			<td>
				<table width="100%" style="text-align:center">
					<tr>
						<?php $i = 1; ?>
						<?php for ($i; $i < 4; $i++) { ?>
						<td><input style="width:50px;" type="number" name="ssg_ppk<?php echo $item->student_id?>[]"></td>
						<td><input style="width:50px;" type="number" name="ssg_ppk_rem<?php echo $item->student_id?>[]"></td>
						<?php } ?>
						<td><input readonly type="number" name="ssg_avg_ppk<?php echo $item->student_id?>"></td>
					</tr>
				</table>
			</td>
			<td>
				<table width="100%" style="text-align:center">
					<tr>
						<?php $i = 1; ?>
						<?php for ($i; $i < 4; $i++) { ?>
						<td><input style="width:50px;" type="number" name="ssg_ppr<?php echo $item->student_id?>[]"></td>
						<td><input style="width:50px;" type="number" name="ssg_ppr_rem<?php echo $item->student_id?>[]"></td>
						<?php } ?>
						<td><input readonly type="number" name="ssg_avg_ppr<?php echo $item->student_id?>"></td>
					</tr>
				</table>
			</td>
			<td>
				<table width="100%" style="text-align:center">
					<tr>
						<?php $i = 1; ?>
						<?php for ($i; $i < 4; $i++) { ?>
						<td><input style="width:50px;" type="number" name="ssg_ppj<?php echo $item->student_id?>[]"></td>
						<td><input style="width:50px;" type="number" name="ssg_ppj_rem<?php echo $item->student_id?>[]"></td>
						<?php } ?>
						<td><input readonly type="number" name="ssg_avg_ppj<?php echo $item->student_id?>"></td>
					</tr>
				</table>
			</td>
			<td>
				<table width="100%" style="text-align:center">
					<tr>
						<td><input style="width:50px;" type="number" name="ssg_md<?php echo $item->student_id?>"></td>
						<td><input style="width:50px;" readonly type="number" name="ssg_avg_md<?php echo $item->student_id?>"></td>
						<td><input style="width:50px;" type="number" name="ssg_st<?php echo $item->student_id?>"></td>
						<td><input style="width:50px;" readonly type="number" name="ssg_avg_st<?php echo $item->student_id?>"></td>
					</tr>
				</table>
			</td>
			<td>
				<table width="100%" style="text-align:center">
					<tr>
						<td><input style="width:50px;" readonly type="number" name="ssg_final_score<?php echo $item->student_id?>"></td>
					</tr>
				</table>
			</td>
			<td>
				<table width="100%" style="text-align:center">
					<tr>
						<td><input style="width:50px;" readonly type="number" name="ssg_conversion<?php echo $item->student_id?>"></td>
					</tr>
				</table>
			</td>
			<td>
				<table width="100%" style="text-align:center">
					<tr>
						<td><input style="width:50px;" readonly type="number" name="ssg_predikat<?php echo $item->student_id?>"></td>
					</tr>
				</table>
			</td>
			<td>
				<input type="text" style="width:250px" name="ssg_remark<?php echo $item->student_id?>">
			</td>
		</tr>
		<?php }; ?>
	</tbody>
</table>
