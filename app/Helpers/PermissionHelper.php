<?php

function permissionChecker($rawPermissions='')
{
	// if (auth()->user()->role('Super Admin')) {
 //        return;
 //    }

	// $role = auth()->user()->roles[0];
	// $userPermissions = $role->permissions->pluck('name')->toArray();

	// $permissions = explode(',', $rawPermissions);
	// $diff = array_diff($permissions, $userPermissions);
	
	// if (count($diff) != 0) {
	// 	return abort(401);
	// }

	if (!auth()->user()->can($rawPermissions)) {
		return abort(401);
	}
}