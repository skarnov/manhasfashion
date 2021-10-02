<?php foreach ($all_subcategories as $subcategory): ?>
    <option value="<?php echo $subcategory->pk_category_id; ?>"><?php echo $subcategory->category_name; ?></option>
<?php endforeach; ?>