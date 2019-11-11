import Client from './views/components/Client/Client'
import CreateEditClient from './views/components/Client/CreateEditClient'
import TableClients from './views/components/Client/TableClients'

import Call from './views/components/Call/Call'
import CreateEditCall from './views/components/Call/CreateEditCall'
import TableCalls from './views/components/Call/TableCall'

import Meetings from './views/components/Meeting/Meeting'
import NewMeeting from './views/components/Meeting/NewMeeting'
import TableMeeting from './views/components/Meeting/TableMeeting'

import Receivables from './views/components/Receivables/Receivables'
import TableRecivables from './views/components/Receivables/TableRecivables'

import Login from './views/components/Auth/Login'
import Registration from './views/components/Auth/Registration'

export default [
    {
        path: '/clients',
        component: Client,
        meta: {
            auth: true,
        },
        children: [
            {
                path: '/',
                name: 'clients',
                component: TableClients,
                meta: {
                    auth: true,
                },
            },
            {
                path: 'new',
                name: 'clients.new',
                component: CreateEditClient,
                meta: {
                    auth: true,
                },
            },
            {
                path: 'edit/:id',
                name: 'clients.edit',
                component: CreateEditClient,
                meta: {
                    auth: true,
                },
            },
        ]
    },

    {
        path: '/calls',
        component: Call,
        meta: {
            auth: true,
        },
        children: [

            {
                path: '/',
                name: 'calls',
                component: TableCalls,
                meta: {
                    auth: true,
                },
            },
            {
                path: 'new',
                name: 'calls.new',
                component: CreateEditCall,
                meta: {
                    auth: true,
                },
            },
            {
                path: 'edit/:id',
                name: 'calls.edit',
                component: CreateEditCall,
                meta: {
                    auth: true,
                },
            },
        ]
    },
    {
        path: '/meetings',
        component: Meetings,
        meta: {
            auth: true,
        },
        children: [
            {
                path: '/',
                name: 'meetings',
                component: TableMeeting,
                meta: {
                    auth: true,
                },
            },
            {
                path: 'new',
                name: 'meetings.new',
                component: NewMeeting,
                meta: {
                    auth: true,
                },
            },
        ]
    },
    {
        path: '/receivables',
        component: Receivables,
        meta: {
            auth: true,
        },
        children: [
            {
                path: '/',
                name: 'receivables',
                component: TableRecivables,
                meta: {
                    auth: true,
                },
            },
        ]
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: {
            auth: false,
        },
    },
    {
        path: '/registration',
        name: 'register',
        component: Registration,
        meta: {
            auth: false,
        },
    },
];
