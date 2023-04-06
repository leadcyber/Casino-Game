import {
    MENU_NAVIGATION_STATUS,
    CHAT_DRAWER_STATUS,
    MENU_NAVIGATION_MINI_VARIANT_STATUS,
} from '../mutation-types'

// state
export const state = {
    isMenuOpened: window.isMenuOpened ? window.isMenuOpened : false,
    isChatOpened: window.isChatOpened ? window.isChatOpened : false,
    isMenuMiniVariant: window.isMenuMiniVariant ? window.isMenuMiniVariant : false,
};

// getters
export const getters = {
}

// mutations
export const mutations = {
    [MENU_NAVIGATION_STATUS] (state, isMenuOpened) {
        state.isMenuOpened = isMenuOpened;
    },

    [CHAT_DRAWER_STATUS] (state, isChatOpened) {
        state.isChatOpened = isChatOpened;
    },

    [MENU_NAVIGATION_MINI_VARIANT_STATUS] (state, isMenuMiniVariant) {
        state.isMenuMiniVariant = isMenuMiniVariant;
    }

}

// actions
export const actions = {
    MenuNavigationStatus ({commit}, isMenuOpened) {
        commit(MENU_NAVIGATION_STATUS, isMenuOpened);
    },
    ChatDrawerStatus ({commit}, isChatOpened) {
        commit(CHAT_DRAWER_STATUS, isChatOpened);
    },
    MenuNavigationMiniVariantStatus ({commit}, isMenuMiniVariant) {
        commit(MENU_NAVIGATION_MINI_VARIANT_STATUS, isMenuMiniVariant);
    },
}
