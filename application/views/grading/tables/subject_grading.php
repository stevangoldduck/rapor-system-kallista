<table border="1" id="tb_class_grade" width="100%" class="table table-striped" style="text-align:center">
	<thead>
		<tr>
			<th style="text-align:center;">Student</th>
			<th>
				<table border="1" width="100%" style="text-align:center">
					<tr>
						<td colspan="10">
							Ulangan
						</td>
						<td>Rata-rata</td>
					</tr>
					<tr>
						<?php $i = 1; ?>
						<?php for ($i; $i < 6; $i++) { ?>
						<td style="width:50px;"><?php echo $i ?></td>
						<td style="width:50px;">Rem</td>
						<?php } ?>
						<td><?php echo $subject['sak_u_aw'] ?>%</td>
					</tr>
				</table>
			</th>
			<th>
				<table border="1" width="100%" style="text-align:center">
					<tr>
						<td colspan="10">
							Tugas
						</td>
						<td>Rata-rata</td>
					</tr>
					<tr>
						<?php $i = 1; ?>
						<?php for ($i; $i < 6; $i++) { ?>
						<td style="width:50px;"><?php echo $i ?></td>
						<td style="width:50px;">Rem</td>
						<?php } ?>
						<td><?php echo $subject['sak_t_aw'] ?>%</td>
					</tr>
				</table>
			</th>
			<th>
				<table border="1" width="100%" style="text-align:center">
					<tr>
						<td colspan="2">
							Mid Tst
						</td>
						<td colspan="2">
							Smst Tst
						</td>
					</tr>
					<tr>
						<td style="width:50px;">Nilai</td>
						<td style="width:50px;"><?php echo $subject['sak_md_aw'] ?>%</td>
						<td style="width:50px;">Nilai</td>
						<td style="width:50px;"><?php echo $subject['sak_st_aw'] ?>%</td>
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
		<?php foreach ($knowledge as $item) { ?>
		<tr>
			<td style="padding-left:100px;padding-right:100px;">
				<?php echo $item->student_name ?>
				<input type="hidden" name="students[]">
			</td>
			<td>
				<table width="100%" style="text-align:center">
					<tr>
						<?php $i = 0; ?>
						<?php for ($i; $i < 5; $i++) { ?>
						<td><input style="width:50px;" value="<?php echo $item->{'skg_u_'.$alpha[$i]} ; ?>" type="number" name="skg_u<?php echo $item->student_id?>[]"></td>
						<td><input style="width:50px;" type="number" value="<?php echo $item->{'skg_u_rem'.$alpha[$i]} ; ?>" name="skg_u_rem<?php echo $item->student_id?>[]"></td>
						<?php } ?>
						<td><input readonly type="number" value="<?php echo $item->skg_avg_u ; ?>"  name="skg_avg_u<?php echo $item->student_id?>"></td>
					</tr>
				</table>
			</td>
			<td>
				<table width="100%" style="text-align:center">
					<tr>
						<?php $i = 0; ?>
						<?php for ($i; $i < 5; $i++) { ?>
						<td><input style="width:50px;" value="<?php echo $item->{'skg_t_'.$alpha[$i]} ; ?>" type="number" name="skg_t<?php echo $item->student_id?>[]"></td>
						<td><input style="width:50px;" value="<?php echo $item->{'skg_t_rem'.$alpha[$i]} ; ?>" type="number" name="skg_t_rem<?php echo $item->student_id?>[]"></td>
						<?php } ?>
						<td><input readonly type="number" value="<?php echo $item->skg_avg_t ; ?>" name="skg_avg_t"></td>
					</tr>
				</table>
			</td>
			<td>
				<table width="100%" style="text-align:center">
					<tr>
						<td><input style="width:50px;" value="<?php echo $item->skg_md_score ; ?>" type="number" name="skg_md<?php echo $item->student_id?>"></td>
						<td><input style="width:50px;" value="<?php echo $item->skg_avg_md ; ?>" readonly type="number" name="skg_avg_md<?php echo $item->student_id?>"></td>
						<td><input style="width:50px;" value="<?php echo $item->skg_st_score ; ?>" type="number" name="skg_st<?php echo $item->student_id?>"></td>
						<td><input style="width:50px;" value="<?php echo $item->skg_avg_st ; ?>" readonly type="number" name="skg_avg_st<?php echo $item->student_id?>" ></td>
					</tr>
				</table>
			</td>
			<td>
				<table width="100%" style="text-align:center">
					<tr>
						<td><input style="width:50px;" value="<?php echo $item->skg_final_score ; ?>" readonly type="number" name="skg_final_score<?php echo $item->student_id?>"></td>
					</tr>
				</table>
			</td>
			<td>
				<table width="100%" style="text-align:center">
					<tr>
						<td><input style="width:50px;" readonly value="<?php echo $item->skg_conversion ; ?>" type="number" name="skg_conversion<?php echo $item->student_id?>"></td>
					</tr>
				</table>
			</td>
			<td>
				<table width="100%" style="text-align:center">
					<tr>
						<td><input style="width:50px;" readonly value="<?php echo $item->skg_predikat ; ?>" type="text" name="skg_predikat<?php echo $item->student_id?>" id=""></td>
					</tr>
				</table>
			</td>
			<td>
				<input type="text" style="width:250px" value="<?php echo $item->skg_remark ; ?>" name="skg_remark<?php echo $item->student_id?>">
			</td>
		</tr>
		<?php }; ?>
	</tbody>
</table>
