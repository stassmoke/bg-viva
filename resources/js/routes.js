import Client from './views/components/Client/Client'
import CreateEditClient from './views/components/Client/CreateEditClient'
import TableClients from './views/components/Client/TableClients'

import Call from './views/components/Call/Call'
import NewCall from './views/components/Call/NewCall'
import TableCall from './views/components/Call/TableCall'

import Meetings from './views/components/Meeting/Meeting'
import NewMeeting from './views/components/Meeting/NewMeeting'
import TableMeeting from './views/components/Meeting/TableMeeting'

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
        path: '/call',
        component: Call,
        children: [
            {
                path: '/',
                name: 'calls',
                component: TableCall,
                meta: {
                    auth: true,
                },
            },
            {
                path: 'new',
                name: 'calls.new',
                component: NewCall,
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
