<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { LayoutGrid, Pencil, BookOpenText, List } from 'lucide-vue-next';
import AppLogo from '@/components/AppLogo.vue';
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { dashboard } from '@/routes';
import type { NavItem } from '@/types';
import { index as category_index }  from "@/routes/categories";
import { index as recipe_index } from "@/routes/recipes";

const mainNavItems: NavItem[] = [
    {
        title: 'Din kogebog',
        href: dashboard(),
        icon: BookOpenText,
    },
    {
        title: 'Tilføj opskrift',
        href: recipe_index(),
        icon: Pencil,
    },
    {
        title: 'Tilføj kategori',
        href: category_index(),
        icon: Pencil,
    },
    {
        title: 'Se alle opskrifter',
        href: '',
        icon: LayoutGrid,
    },
    {
        title: 'Register',
        href: '',
        icon: List,
    },
];

const footerNavItems: NavItem[] = [

];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="dashboard()">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <NavFooter :items="footerNavItems" />
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
