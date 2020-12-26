<div class="form-group">
    <h5>المديرين</h5>
    <fieldset>
        <legend>
            <label class="kt-checkbox">
                <input type="checkbox" class="checkAll" @if(isset($role) && $role->hasPermission(['show_admins' , 'add_admins'])) checked @endif>
                <span class="first"></span>
            </label>
        </legend>
        <div class="row">
            <div class="col-md-6 mb-4">
                <label class="kt-checkbox">
                    <input name="permissions[]" value="show_admins" type="checkbox" @if(isset($role) && $role->hasPermission('show_admins')) checked @endif> عرض
                    <span></span>
                </label>
            </div>
            <div class="col-md-6 mb-4">
                <label class="kt-checkbox">
                    <input name="permissions[]" value="add_admins" type="checkbox" @if(isset($role) && $role->hasPermission('add_admins')) checked @endif>  إضافة / تعديل
                    <span></span>
                </label>
            </div>

        </div>
    </fieldset>
</div>

<div class="form-group">
    <h5>مجموعات الصلاحيات</h5>
    <fieldset>
        <legend>
            <label class="kt-checkbox">
                <input type="checkbox" class="checkAll" @if(isset($role) && $role->hasPermission(['add_roles'])) checked @endif>
                <span class="first"></span>
            </label>
        </legend>
        <div class="row">
            <div class="col-md-6 mb-4">
                <label class="kt-checkbox">
                    <input name="permissions[]" value="add_roles" type="checkbox"
                           @if(isset($role) && $role->hasPermission('add_roles')) checked @endif>  إضافة / تعديل
                    <span></span>
                </label>
            </div>

        </div>
    </fieldset>
</div>

<div class="form-group">
    <h5>المستخدمين</h5>
    <fieldset>
        <legend>
            <label class="kt-checkbox">
                <input type="checkbox" class="checkAll" @if(isset($role) && $role->hasPermission(['show_users' , 'add_users'])) checked @endif>
                <span class="first"></span>
            </label>
        </legend>
        <div class="row">
            <div class="col-md-6 mb-4">
                <label class="kt-checkbox">
                    <input name="permissions[]" value="show_users" type="checkbox"
                           @if(isset($role) && $role->hasPermission('show_users')) checked @endif>  عرض
                    <span></span>
                </label>
            </div>

            <div class="col-md-6 mb-4">
                <label class="kt-checkbox">
                    <input name="permissions[]" value="add_users" type="checkbox"
                           @if(isset($role) && $role->hasPermission('add_users')) checked @endif>  إضافة / تعديل
                    <span></span>
                </label>
            </div>

        </div>
    </fieldset>
</div>

<div class="form-group">
    <h5> الدول و المدن</h5>
    <fieldset>
        <legend>
            <label class="kt-checkbox">
                <input type="checkbox" class="checkAll" @if(isset($role) && $role->hasPermission(['manage_countries' , 'manage_cities'])) checked @endif>
                <span class="first"></span>
            </label>
        </legend>
        <div class="row">
            <div class="col-md-6 mb-4">
                <label class="kt-checkbox">
                    <input name="permissions[]" value="manage_countries" type="checkbox"
                           @if(isset($role) && $role->hasPermission('manage_countries')) checked @endif>  ادارة الدول
                    <span></span>
                </label>
            </div>

            <div class="col-md-6 mb-4">
                <label class="kt-checkbox">
                    <input name="permissions[]" value="manage_cities" type="checkbox"
                           @if(isset($role) && $role->hasPermission('manage_cities')) checked @endif>  ادارة المدن
                    <span></span>
                </label>
            </div>

        </div>
    </fieldset>
</div>

<div class="form-group">
    <h5> الإهتمامات </h5>
    <fieldset>
        <legend>
            <label class="kt-checkbox">
                <input type="checkbox" class="checkAll" @if(isset($role) && $role->hasPermission(['manage_interests'])) checked @endif>
                <span class="first"></span>
            </label>
        </legend>
        <div class="row">
            <div class="col-md-6 mb-4">
                <label class="kt-checkbox">
                    <input name="permissions[]" value="manage_interests" type="checkbox"
                           @if(isset($role) && $role->hasPermission('manage_interests')) checked @endif>  ادارة الإهتمامات
                    <span></span>
                </label>
            </div>

        </div>
    </fieldset>
</div>



<div class="form-group">
    <h5> صفحات الموقع </h5>
    <fieldset>
        <legend>
            <label class="kt-checkbox">
                <input type="checkbox" class="checkAll" @if(isset($role) && $role->hasPermission(['manage_pages'])) checked @endif>
                <span class="first"></span>
            </label>
        </legend>
        <div class="row">
            <div class="col-md-6 mb-4">
                <label class="kt-checkbox">
                    <input name="permissions[]" value="manage_pages" type="checkbox"
                           @if(isset($role) && $role->hasPermission('manage_pages')) checked @endif>  ادارة الصفحات
                    <span></span>
                </label>
            </div>

        </div>
    </fieldset>
</div>
<div class="form-group">
    <h5> الاسئلة الشائعة </h5>
    <fieldset>
        <legend>
            <label class="kt-checkbox">
                <input type="checkbox" class="checkAll" @if(isset($role) && $role->hasPermission(['manage_faqs'])) checked @endif>
                <span class="first"></span>
            </label>
        </legend>
        <div class="row">
            <div class="col-md-6 mb-4">
                <label class="kt-checkbox">
                    <input name="permissions[]" value="manage_faqs" type="checkbox"
                           @if(isset($role) && $role->hasPermission('manage_faqs')) checked @endif>  ادارة الاسئلة الشائعة
                    <span></span>
                </label>
            </div>

        </div>
    </fieldset>
</div>

<div class="form-group">
    <h5> الأسعار </h5>
    <fieldset>
        <legend>
            <label class="kt-checkbox">
                <input type="checkbox" class="checkAll" @if(isset($role) && $role->hasPermission(['manage_prices'])) checked @endif>
                <span class="first"></span>
            </label>
        </legend>
        <div class="row">
            <div class="col-md-6 mb-4">
                <label class="kt-checkbox">
                    <input name="permissions[]" value="manage_prices" type="checkbox"
                           @if(isset($role) && $role->hasPermission('manage_prices')) checked @endif>  ادارة الأسعار
                    <span></span>
                </label>
            </div>

        </div>
    </fieldset>
</div>

<div class="form-group">
    <h5> انواع التجارب </h5>
    <fieldset>
        <legend>
            <label class="kt-checkbox">
                <input type="checkbox" class="checkAll" @if(isset($role) && $role->hasPermission(['manage_types'])) checked @endif>
                <span class="first"></span>
            </label>
        </legend>
        <div class="row">
            <div class="col-md-6 mb-4">
                <label class="kt-checkbox">
                    <input name="permissions[]" value="manage_types" type="checkbox"
                           @if(isset($role) && $role->hasPermission('manage_types')) checked @endif>  ادارة انواع التجارب
                    <span></span>
                </label>
            </div>

        </div>
    </fieldset>
</div>


<div class="form-group">
    <h5> مجالات التجارب </h5>
    <fieldset>
        <legend>
            <label class="kt-checkbox">
                <input type="checkbox" class="checkAll" @if(isset($role) && $role->hasPermission(['manage_fields'])) checked @endif>
                <span class="first"></span>
            </label>
        </legend>
        <div class="row">
            <div class="col-md-6 mb-4">
                <label class="kt-checkbox">
                    <input name="permissions[]" value="manage_fields" type="checkbox"
                           @if(isset($role) && $role->hasPermission('manage_fields')) checked @endif>  ادارة مجالات التجارب
                    <span></span>
                </label>
            </div>

        </div>
    </fieldset>
</div>


